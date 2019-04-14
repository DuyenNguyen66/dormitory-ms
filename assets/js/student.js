$('.building_id').change(function(){
	var building_id = $(this).val();
	$.get('register/getFloorByBuilding', {building_id:building_id},function(data){
		$('.floor_id').html(data);
		$('.floor_id').change(function(){
			var floor_id = $(this).val();
			$.get('register/getRoomByFloor', {building_id:building_id,floor_id:floor_id}, function(data){
				$('#room_table').html(data);
			});
		});
	});
});

function loadRoom(building_id, floor_id) {
	$.get('register/getFloorByBuilding', {building_id:building_id},function(data){
		$('.floor_id').html(data);
		$.get('register/getRoomByFloor', {building_id:building_id,floor_id:floor_id}, function(data){
			$('#room_table').html(data);
		});
	});
}
loadRoom(building_id, floor_id);
