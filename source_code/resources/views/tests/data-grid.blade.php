@extends('admin/layouts/master')

@section('main-content')
	<style>
		{{ file_get_contents(base_path().'/vendor/blackbear/data-grid/src/assets/css/data-table.css') }}
	</style>
	<script>
		{!! file_get_contents(base_path().'/vendor/blackbear/data-grid/src/assets/js/data-table.js') !!}
	</script>
	<script>
		$(function() {
		   	DataTable.init({
				onChangeItem: function(row, e) {
				    console.log(row);
                    console.log($(row).attr('data-item-json'));
//				    console.log(JSON.parse($(item).attr('data-item-json')));
				},
				onCheckAll: function(e) {

				}
			})
		});
	</script>
	<div class="panel">
		<div class="panel-body">
			{!! $tableContent !!}
		</div>
	</div>
@stop