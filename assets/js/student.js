$('.building_id').change(function(){
	var building_id = $(this).val();
	$.get('register/getFloorByBuilding', {building_id:building_id},function(data){
		$('.floor_id').html(data);
		$('.floor_id').change(function(){
			var floor_id = $(this).val();
			$.get('register/getRoomByFloor', {floor_id:floor_id}, function(data){
				$('#room_table').html(data);
			});
		});
	});
});