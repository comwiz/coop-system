    $(document).ready(function(){

        //Remit Cash
        $("#tq").keyup(function(){

            var multiplier = 1000;
            var totatv = 0;

            totatv = Number($("#tq").val()) * Number(multiplier);

            $("#tv").val(totatv);
        });

        $("#fhq").keyup(function(){

            var multiplier = 500;
            var totatv = 0;

            totatv = Number($("#fhq").val()) * Number(multiplier);

            $("#fhv").val(totatv);
        });

        $("#thq").keyup(function(){

            var multiplier = 200;
            var totatv = 0;

            totatv = Number($("#thq").val()) * Number(multiplier);

            $("#thv").val(totatv);
        });

        $("#ohq").keyup(function(){

            var multiplier = 100;
            var totatv = 0;

            totatv = Number($("#ohq").val()) * Number(multiplier);

            $("#onv").val(totatv);
        });

        $("#ftq").keyup(function(){

            var multiplier = 50;
            var totatv = 0;

            totatv = Number($("#ftq").val()) * Number(multiplier);

            $("#ftv").val(totatv);
        });

        $("#twq").keyup(function(){

            var multiplier = 20;
            var totatv = 0;

            totatv = Number($("#twq").val()) * Number(multiplier);

            $("#twv").val(totatv);
        });

        $("#tnq").keyup(function(){

            var multiplier = 10;
            var totatv = 0;

            totatv = Number($("#tnq").val()) * Number(multiplier);

            $("#tnv").val(totatv);
        });

        $("#fvq").keyup(function(){

            var multiplier = 5;
            var totatv = 0;

            totatv = Number($("#fvq").val()) * Number(multiplier);

            $("#fvv").val(totatv);
        });

        $("#opq").keyup(function(){

            var multiplier = 1;
            var totatv = 0;

            totatv = Number($("#opq").val()) * Number(multiplier);

            $("#opv").val(totatv);
        });

        $("#cnq").keyup(function(){

            var multiplier = .25;
            var totatv = 0;

            totatv = Number($("#cnq").val()) * Number(multiplier);

            $("#cnv").val(totatv);
        });



        $(".quantitym").keyup(function(){

            var totalC = 0;
            $('.famount').each(function() {
                totalC += Number($(this).val());
            });

            //var totalR = 0;
            //totalR = Number(totalC);

            $("#totalCR").val(totalC);

            var remain = Number($("#tc").val()) - Number(totalC);
            $("#remain").val(remain);
        });
    });