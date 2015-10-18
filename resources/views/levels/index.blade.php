@section('page-styles')

	<style>
		#data-table .ui-sortable-helper {
		    padding: 2px;
		    width: 50px;
		    height: 20px;
		    border: 1px solid #333;
		    background: #EEE;
		}
		
		#data-table .ui-state-highlight {
			background-color:#d9edf7;
			border: none;
		}

		#data-table .ui-state-highlight td {
			border:none;
		}

	</style>

@stop


@extends('layout')



@section('content')

	<h1>Niveles:</h1>
	<hr>	

	
	<div class="row">
		<div class="col-xs-12">	

		@if ( $levels->isEmpty() )

			<h3>No existen niveles creados:</h3>
			
			<a href="" class="btn btn-primary btn-lg">
				Crear Nivel
				<i class="fa fa-plus"></i>
			</a>

		@else

			{{-- http://stackoverflow.com/questions/18614695/sort-or-rearrange-rows-of-a-table-in-angularjs-drag-and-drop --}}
			{{-- http://jsfiddle.net/SSSUUUSSS/Bsusr/1/ --}}
			{{-- http://wenzhixin.net.cn/p/bootstrap-table/docs/examples.html#table-select --}}
			{{-- http://wenzhixin.net.cn/p/bootstrap-table/docs/examples.html#disabled-checkbox-table --}}
			{{-- http://bootstrap-table.wenzhixin.net.cn/ --}}

			<table id="data-table"
               	data-toggle="table"
               	data-detail-view="true"
               	data-detail-formatter="detailFormatter"
               	data-pagination="true"
           		data-page-size="10"
           		data-page-list="[5,8,10]"
           		data-pagination-first-text="Primero"
           		data-pagination-pre-text="Anterior"
           		data-pagination-next-text="Siguiente"
           		data-pagination-last-text="Ultimo"               	
               	data-url="/admin/levels/getjson">
	            
	            <thead>
		            <tr>
		            	<th data-field="state" data-checkbox="true"></th>
		                <th data-halign="center" data-align="center" data-field="level_index">Indice</th>
		                <th data-formatter="titleColumnFormat" data-field="title">Titulo</th>
		                <th data-field="description">Descripcion</th>
		            	<th data-halign="center" data-align="center" data-events="actionsEvents" data-formatter="actionsFormat">Acciones</th>
		            	<th data-halign="center" data-align="center" data-formatter="sortHandlerFormat">Ordenar</th>
		            </tr>
	            </thead>
	            
	            {{-- <tbody ui:sortable ></tbody> --}}
	            <tbody id="sortable-items" ></tbody>
        	</table>
		

		@endif



		</div>
	</div>
	


@stop

@section('page-scripts')

{{-- fetch Level data restfully from route admin/levels/getjson --}}
<script>
// (function($){
	var $table = $('#data-table');


	// after load tables has been render	
	$table.on('load-success.bs.table', function( data ) {

		// sortable ui tr 
	    $( "#sortable-items" ).sortable({
	    	placeholder: "ui-state-highlight", // placeholder display
	    	items: "tr:not(.detail-view)", // exclude
	    	handle: ".sortHandler", // handler

	    });
	 
	 
	    $( "#sortable-items tr" ).disableSelection();						
	

		//add class to sorth
	    $('tbody tr').filter( function() {

	    	$('td:last', this).addClass('sortHandler');
	    
	    });

	});


	// format the column title
	function titleColumnFormat ( value, data )
	{
		
		return '<a href="/admin/levels/' +  data.id  +'/edit">' + value + '</a>';
	
	}

    
	// format for row details (Lessons)
    function detailFormatter(index, row) 
    {
        var html = [];

      	if ( row.lessons.length > 0 ) {

	        $.each(row, function (key, value) {
	           	
            	// html.push('<p><b>' + key + ':</b> ' + value + '</p>');
	           	
	           	if ( key === 'lessons' &&  key.length > 0 ){
	           		
	           		html.push('<h4>Lecciones Asignadas:</h4>');	

	           		html.push('<ol>');	
	           		$.each( value, function ( lessonKey, lesson ) {

	           			html.push('<li data-lesson-index="' + lesson.id + '" ><a href="' + lesson.id + '">' + lesson.title + '</a></li>' );

	           		})

	           		html.push('</ol>');
	           		
	           	} 	

	        });
      		
      	}else{

      		html.push('<div class="clearfix alert alert-info" role="alert"><span>No existen Lecciones agregadas a este Nivel</span>  <a class="btn btn-primary btn-sm pull-right" href="#">Agregar Leccion a este Nivel<i class="fa fa-plus"></i></a> </div>');	

      	}

        return html.join('');
    }


	// format the Acciones column
	function actionsFormat () 
	{
		return [
            
            '<a class="edit" href="javascript:void(0)" title="edit">',
            '<i class="glyphicon glyphicon-edit"></i>',
            '</a>  ',

            '<a class="remove" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-trash"></i>',
            '</a>'
        
        ].join('');
	}



	function sortHandlerFormat ()
	{
		return [
			'<i class="glyphicon glyphicon-move">',
		].join('');
	}


    window.actionsEvents = {
        
        'click .like': function (e, value, row, index) {
            alert('You click like action, row: ' + JSON.stringify(row));
        },

        'click .remove': function (e, value, row, index) {
            $table.bootstrapTable('remove', {
                field: 'id',
                values: [row.id]
            });
        }
    };

// })(jQuery);    
</script>

@stop