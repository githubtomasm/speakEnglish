<?php

namespace App\Http\Controllers;


use App\Level;
use App\Lesson;


class ApiLevelsController extends ApiController
{


    public function __construct ()
    {
        //$this->middleware('auth');
        //$this->middleware('rolesCanEdit'); 
    }

  

    /**
     * Display a listing Levels and associated lessons.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        # fetch all levels and associated lessons for each level         
        $level = Level::with(array( 'lessons' => function ( $query ) {

            $query->addSelect(array('id', 'level_id', 'title', 'description'));
        
        }))->orderBy('level_index', 'ASC')->get(['id', 'user_id', 'level_index', 'title', 'description']);


        # return view data        
        return $this->responseSuccess( 'Niveles Cargados Exitosamente', $level->toArray() );
    }





    /**
     * Create Levels 
     * @return \Illuminate\Http\Response
     */
    public function create( )
    {

        # will be use as current level_index for sorting the levels
        $currentLevelIndex = Level::lastLelveIndex();    


        # users with teacher role
        $teachers = User::getUsersByRoleName('teacher');


        # un assigned lessons
        $unAssignedLessons = Lesson::all()->where('level_id', null);

        return $this->setStatusCode(200)->respond([
            'currentLevelIndex'     => $currentLevelIndex,            
            'teachers'              => $teachers,
            'unAssignedLessons'     => $unAssignedLessons,
        ]);
    }






    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Controllers\LevelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( LevelRequest $request )
    {

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

                $lesson->save();
            }

        }

        # flash message level has been created
        flash()->success('Exito', 'Nivel Creado');
        return $this->responseSuccess( 'Nivel Creado Exitosamente');
    }





    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {

        $level = Level::find( $id );

        if ( ! $level ) {

            return $this->responseNotFound('El Nivel al cual se intenta Accesar no existe');

        }

        # un assigned lessons
        $unSignedLessons = Lesson::where('level_id', null)->get(['id', 'level_id', 'title', 'description']);
      

        # assigned lessons
        $assignedLessons = $level->lessons()->get(['id', 'level_id', 'title', 'description']);

        # pass a single array 
        $lessons = array_merge( $assignedLessons->toArray(), $unSignedLessons->toArray() );

        return $this->respond([
            'data' => [
                'level'             => $level->toArray(), # obj                    
                'lessons'           => $lessons, 
            ]
        ]);
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( LevelRequest $request, $id)
    {

        $level = Level::find($id);

        if( ! $level ){

            flash()->error('Error', 'No se encontro el Nivel que estas tratando de Editar');
            return $this->responseNotFound('No se encontro el Nivel que estas tratando de Editar');            

        }

        $updateLevel = $request->all();

        if( isset($updateLevel['title']) && $updateLevel['description'] ){

            $level->title           = $updateLevel['title'];
            $level->description     = $updateLevel['description'];
            $level->save();

        }


        # update level's existing lessons relation ships
        # attach or deattach from level
        if ( isset( $updateLevel['lesson'] ) ){

                $lesson = Lesson::find( $updateLevel['lesson'] );

                if( ! $lesson ) {

                    flash()->error('Error', 'Problema eliminar leccion id = ' . $lessonId );    
                    return $this->responseNotFound('No se encontro la Leccion que se esta tratando de Editar');            
               
                }

                // $value = ( $lesson->level_id !== 0 ) ? 

                $lesson->level_id = null;
                $lesson->save();
        }


        flash()->success('Exito', 'Nivel Actualizado exitosamente exitosamente');
        return redirect()->route('admin.levels.index');
    }






    /**
     * Update the order that the levels are sort (level_index) 
     * @return \Illuminate\Http\Response
     */
    public function updaIndex ( LevelRequest $request)
    {

        $inputs = $request->all();

        foreach ( $inputs as $key => $levelToUpdate ) {

            $level = Level::find( $levelToUpdate['id'] );

            if( ! $level ){ 

                $this->responseNotFound('Nivel no encontrado, cambios no guardados');

            }

            $level->level_index =  $levelToUpdate['index']; 
        }           
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $level = Level::find($id);

        if( ! $level  ){

            return $this->responseNotFound('Nivel no encontrado');

        }

        $level->delete();

        $lessons = $level->lessons()->get();

        foreach ($lessons as $lesson ) {

            $lesson->level_id = null;

        }

        return $this->responseSuccess('Nivel Borrado exitosamente');

    }


}