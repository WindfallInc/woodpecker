<script>
//Start functions.transfer
//begin transfer functions
    function codeview() {

      $( ".textarea" ).toggleClass( "active" );
      $( ".codearea" ).toggleClass( "active" );
    }

    $('body').on('click', '.component-write .fa-pencil', function() {
      $(this).parents( ".component-write" ).children('.form-backdrop').toggleClass( "active" );
      $.each($('.component-write'), function() {
        var forms = $(this).find(".forms");
        var preview = $(this).find(".preview");
          $(preview).find('.input1').html($(forms).find("input[name='input1[]']").val());
          $(preview).find('.input2').html($(forms).find("input[name='input2[]']").val());
          $(preview).find('.input3').html($(forms).find("input[name='input3[]']").val());
          $(preview).find('.input4').html($(forms).find("input[name='input4[]']").val());
          $(preview).find('.input5').html($(forms).find("input[name='input5[]']").val());
          $(preview).find('.input6').html($(forms).find("input[name='input6[]']").val());
      });


    });

    $('body').on('click', '.form-backdrop', function(e) {
      if(e.target == e.currentTarget) {
        $.each($('.component-write'), function() {
          var forms = $(this).find(".forms");
          var preview = $(this).find(".preview");
            $(preview).find('.input1').html($(forms).find("input[name='input1[]']").val());
            $(preview).find('.input2').html($(forms).find("input[name='input2[]']").val());
            $(preview).find('.input3').html($(forms).find("input[name='input3[]']").val());
            $(preview).find('.input4').html($(forms).find("input[name='input4[]']").val());
            $(preview).find('.input5').html($(forms).find("input[name='input5[]']").val());
            $(preview).find('.input6').html($(forms).find("input[name='input6[]']").val());
        });
        $( ".form-backdrop" ).removeClass( "active" );
      }
    });
    $('body').on('click', '.form-backdrop .x', function() {
      $.each($('.component-write'), function() {
        var forms = $(this).find(".forms");
        var preview = $(this).find(".preview");
          $(preview).find('.input1').html($(forms).find("input[name='input1[]']").val());
          $(preview).find('.input2').html($(forms).find("input[name='input2[]']").val());
          $(preview).find('.input3').html($(forms).find("input[name='input3[]']").val());
          $(preview).find('.input4').html($(forms).find("input[name='input4[]']").val());
          $(preview).find('.input5').html($(forms).find("input[name='input5[]']").val());
          $(preview).find('.input6').html($(forms).find("input[name='input6[]']").val());
      });
      $( ".form-backdrop" ).removeClass( "active" );
    });
    $('.backdrop .x').on('click', function(){
      $('#contentoptions').removeClass('active');
    });
      $('.more').on('click', function(){
        $('#contentoptions').addClass('active');
      });

    $('.backdrop').on('click', function(e){
      if(e.target == e.currentTarget) {
        $('#contentoptions').removeClass('active');
      }
    });

</script>