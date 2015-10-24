<?php

namespace App\Http\Controllers;

#import controller Level class

use App\Level;

use App\Role;

use App\User;

use App\Lesson;

use App\Http\Requests;

use App\Http\Requests\LevelRequest;

use Illuminate\Http\Request;

use Illuminate\HttpResponse; 

use App\Http\Controllers\Controller;

use Carbon\Carbon;

use Illuminate\Support\Facades\Redirect;

# use in store method
# use Request;
#use App\Http\Requests\CreateLevelRequest;


# validation for level create
//use Requests;

class LevelsController extends Controller
{


    public function __construct ()
    {   

        $this->middleware('auth');
        $this->middleware('rolesCanEdit'); 

        # get access to global user vars define in Controller App\Http\Controllers::class
        parent::__construct(); 
    }





    /**
     * Levels show Backend
     */
    public function index ()
    {
        
        $levels = level::orderBy('level_index', 'ASC')->get();
        
        return view('levels.index', compact('levels'));     
    }




    /**
     * Display view for edit level
     * @return view 
     */
    public function edit( $id )
    {

        # TODO: listen and catch any expection 
        ######################################    
        // Incremental API -03-Level 2 Responses and Codes
        // flash 
        // error system handler


        $level = Level::find( $id );

        if ( ! $level ) {

            return Redirect::route('admin.level.index')->with([
                'flash_message'             => 'Nivel no existe',
                'flash_message_important'   => true,
            ]);

        }

        # un assigned lessons
        $unAssignedLessons = Lesson::all()->where('level_id', null);
      

        # assigned lessons
        $assignedLessons = $level->lessons()->get(['id', 'title', 'description']);


        return view('levels.edit')->with([
            'level'                 => $level,
            'unAssignedLessons'     => $unAssignedLessons,
            'assignedLessons'       => $assignedLessons
        ]);
    }





    /**
     * save new level into db
     * @param CreateLevelRquest
     * @return response
     *
     * when type hinting a request, this will be process before the body of the method store runs
     * validation fails, redirect back to the las route
     * validation success, process the store method   
     */
    public function store( LevelRequest $request)
    { 

        # get the request object from the validation method defined
        $input = $request->all();

        # Create the level model, persist it to the db and add user level relationship 
        $level = $this->user->levels()->save( Level::create([
            'title'         => $input['title'],
            'description'   => $input['description'],
            'status_id'     => 1,
            'user_id'       => $this->user->id,
            'level_index'   => $input['level_index'], 
            'published_at'  => date('Y-m-d'),
        ]));
        


        # Persist to db any pass lessons associated with the created article 
        if ( isset( $input['lessons'] ) && count($input['lessons']) ){

            foreach ($input['lessons'] as $lessonId) {

                $lesson = Lesson::find($lessonId);

                $lesson->level()->associate( $level );

            }

            $lesson->save();
        }


        # flash message level has been created
        // session()->flash('flash_message', 'Nivel Creado exitosamente'); 


        return redirect()->reoute('admin.level.index')->with([
            'flash_message'             => 'Nivel Creado exitosamente',
            'flash_message_important'   => true,
        ]);


        /**
         * NOTE
         * Laravel FORM REQUEST could be use directly in the controller vor validating simple forms not throug the request class
         */


        # gets super globals $_POSTS and $_GETS
        // $input = Request::all('title'); // get just the input with name attr =  title
        
        # fetch the inputs
        // $input = Request::all();

        /**
         * adding data to db with eloquent
         */  
        #adding inputs one by one
        #$level  = new Level;
        #$level->title = $input['title']

        /*
        $level = new Level([
            'user_id'       =>  $input['user_id'],
            'title'         =>  $input['title'],
            'description'   =>  $input['description'],
            'published_at'  =>  $input['published_at'],
            'level_index'   =>  $input['level_index'],
        ]);


        if( $level->save() ){
            # redirect to levels page
            return redirect('levels');
        }
        */    
    }




    /**
     * Create Levels 
     * @return view
     */
    public function create( )
    {

        # will be use as current level_index for sorting the levels
        $currentLevelIndex = Level::lastLelveIndex();    


        # users with teacher role
        $teachers = User::getUsersByRoleName('teacher');


        # un assigned lessons
        $unAssignedLessons = Lesson::all()->where('level_id', null);
        // $unAssignedLessons = $lesson->all()->where('level_id', null);


        return view('levels.create')->with([
            'currentLevelIndex'     => $currentLevelIndex,            
            'teachers'              => $teachers,
            'unAssignedLessons'     => $unAssignedLessons,
        ]);
    }







    /**
     * response to update Level patch request
     *  
     * @param $id, strin, level id 
     * @param $request, obj, object that have refrence of the post,patch,get,etc super globals by method injection
     *
     * @return redirect to page
     */
    public function update( $id , LevelRequest $request)
    {

        $level = Level::find($id);

        if( ! $level ){

            return Redirect::route('admin.level.index')->with([
                'flash_message'             => 'Nivel Creado exitosamente',
                'flash_message_important'   => true,                
            ]);

        }

        $updateLevel = $request->all();

        $level->title           = $updateLevel['title'];
        $level->description     = $updateLevel['description'];
        $level->save();


        // remove lessons
        if ( isset( $updateLevel['remove'] ) && count($updateLevel['remove']) ){

            foreach ($updateLevel['remove'] as $lessonId => $value ) {

                $lesson = Lesson::find($lessonId);

                if( ! $lesson ) {

                    return Redirect::route('admin.level.edit', [$id])->with([
                        'flash_message' => 'Problema eliminar leccion con id = ' . $lessonId,
                    ]);
                
                }

                $lesson->level_id = null;
                $lesson->save();
            }
        }


       

        
        return redirect()->route('admin.level.index')->with([
            'flash_message'             => 'Nivel Actualizado exitosamente exitosamente',
            'flash_message_important'   => true,
        ]);
        

    }





    


    /**
     * Index rest request 
     * @return json array, all levels with corresponding  lessons
     */   
    public function getLevels ()
    {


        // fetch all levels with respective lessons assign to each level         
        $levels = level::with(array( 'lessons' => function ( $query ) {

            $query->addSelect(array('id', 'level_id', 'title', 'description'));
        
        }))->orderBy('level_index', 'ASC')->get(['id', 'user_id', 'level_index', 'title', 'description']);
        

        return $levels->toJson();
    }







    /* TO REMOVE ******************************************************/


    /**
    * Display all levels
    * load the Levels view
    * name space imported at the top use App\Level
    */
    public function frontEndIndex()
    {
        //return 'Display levels veiew';
        # refrence the complete namespace for the Level Class
        // $levels = \App\Level::all();

        # get all data from the levels table
        //$levels = Level::all(); 

        # get all data from levels table in DESC order
        # another way will be Level::orderBy('published_at', 'desc')->get();
        // $levels = Level::latest('published_at')->get();
        // $levels = Level::orderBy('level_index', 'ASC')->get();

        #Do not display Levels set for future date publishment 
        # $levels = Level::orderBy('level_index', 'ASC')
        #            ->where('published_at', '<=', Carbon::now()) // display only levels that pusblist_at time es equoal or grather than now. 
        #                ->get();

        /**
         * using scope to get the same resutl as above
         * this part "->where('published_at', '<=', Carbon::now())" it's been abstacted to Level model in a published method  
         * this will help in situation where need to replacate this same logic and keep clean the controller
         */
        $levels = level::orderBy('level_index', 'ASC')->published()->get();



        /**
        * return a view inside levels call index.blade.php
        *   pass to that view the array levels with the compact format
        *   an other way view('view_name')->with('levels', $levels);
        */
        return view('levels.index', compact('levels'));
    }






    /**
    * Display single level DELETE
    */
    public function show($id)
    {

        # using elocuent get from the levels table the id pass through the route    
        # $level = Level::find($id);
        
        # find: get the id from levels table
        # OrFail: veryfy if the id exist in the table if not fails and througs expetion 404
        $level = Level::findOrFail($id);


        /**
        * change to be accept a slug and id, when id create validation for  load the level and is_number like drupal
        * 
        */
        return view('levels.show', compact('level'));
    }


}