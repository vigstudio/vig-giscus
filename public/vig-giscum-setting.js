$('#vig_giscum_repository').on('change', function(){
    var value = $(this).val();
    $.ajax({
        method: 'POST',
        url: window.vigrepo + '?name=' + value,

    }).done(function(data){;

        if(data.error) {
            $('#vig_giscum_repository').after('<div id="vig_giscum_repository-error" class="invalid-feedback" style="display: block;">'+data.error+'.</div>')
        }
        $('#vig_giscum_repository_id').val(data.repositoryId);
        $('#vig_giscum_repository_show').html('');
        $('#vig_giscum_repository_show').html('ID: '+ data.repositoryId);
        $.each(data.categories, function(index, val){
            $('#vig_giscum_category_id').append($('<option>', {value: val.id, text: val.name}));
        })

    })
})

$('#vig_giscum_category_id').on('change', function(){
    var value = $(this).find(':selected').text();
    $('#vig_giscum_category').val(value);
    $('#vig_giscum_category_show').html();
    $('#vig_giscum_category_show').html('ID: '+ $(this).val());
})

$( document ).ready( function(){
    var value = $('#vig_giscum_repository').val();

    $.ajax({
        method: 'POST',
        url: window.vigrepo + '?name=' + value,

    }).done(function(data){;
        $('#vig_giscum_repository_id').val(data.repositoryId);
        $.each(data.categories, function(index, val){
            $('#vig_giscum_category_id').append($('<option>', {value: val.id, text: val.name, selected: window.vigcategory == val.id}));
        })

    })
})
