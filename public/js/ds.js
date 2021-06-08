$( document ).ready(function() {
    $("select[name=privileges]").change(function() {
        if (this.value == "inputer") {
            $(".if-show").show();
        } else {
            $(".if-show").hide();
        }
    });

    $("input[type=date]").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change");

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    
        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        });
    });
    
    $("#customFile").on('input', function(){
        if(this.files.length){
            $(".custom-file-label").html(this.files[0].name);
        }
    });
});
