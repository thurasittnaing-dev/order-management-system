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
