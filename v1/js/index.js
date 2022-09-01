$("#btn-submit").click((e)=>{
    e.preventDefault();
    var mssv = $("#mssv").val();
    if(mssv === "") {
        $("#mssv").focus();
    }
    else {
        var regex = /^31\d{8}$/gm;
        if(!regex.test(mssv)) {
            alert("Mã số sinh viên không hợp lệ");
        }
        else {
            let form = $("form");
            form.submit();
        }
    }
});


