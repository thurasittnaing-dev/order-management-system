$(".lib-s2").select2({
    placeholder: "--Select--", // placeholder
    allowClear: true, // clear btn
    width: "100%", // for specific width
});

$(".num-only").on("keyup", function () {
    var value = $(this).val();
    var cleanedValue = value.replace(/\D/g, "");
    $(this).val(cleanedValue);
});

$(".table-responsive").on("show.bs.dropdown", function () {
    $(".table-responsive").css("overflow", "inherit");
});

$(".table-responsive").on("hide.bs.dropdown", function () {
    $(".table-responsive").css("overflow", "auto");
});

$(".lib-s2-multiple").select2({
    multiple:true,
    placeholder: "--Select--", // placeholder
    allowClear: true, // clear btn
    width: "100%", // for specific width
});
