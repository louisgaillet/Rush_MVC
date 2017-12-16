$( document ).ready(function() {
    $('[name=tags]').hide();
	if($('.profil-user')){
    	var groupe = $('.profil-user').find('[name = groupe]').val();
    	var status = $('.profil-user').find('[name = status]').val();
    	$('[name=groupe-select]').val(groupe);
    	$('[name=status-select]').val(status);
    }

    if($('.update-post')){
    	var value = $('.update-post').find('[name = valueCategory]').val();
    	$('[name=category]').val(value);
    	//$('.file').hide();
    	$('.delete').on('click', function(){
    		$('.file').show(200);
    		$('.loading-picture').hide(200);
    	});
    }
});