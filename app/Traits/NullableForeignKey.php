<?php 
namespace App\Traits;
 

trait NullableForeignKey {

    public static function bootNullableForeignKey() {

        // observe whenever we insert or update
        static::saving(function ($model) {

            // check they even have any keys set
            if(isset($model->nullableForeignKeys) ) {

                foreach( $model->nullableForeignKeys as $key) {

                    // if the input coming in is false-y, set it to null

                    if( ! $model->{$key} ) {

                        $model->{$key} = null;

                    }

                }

            }

        });

    }

}