var detail_ = function(id){
    $.ajax({
        url: baseUrl + "employee/ajax_detail",
        type: 'POST',
        dataType: 'JSON',
        data: {data: id},
        beforeSend: function() {
          mApp.block("#mal-table", {
            overlayColor: "#000000",
            type: "loader",
            state: "info",
            size: "lg"
          })
        },
        success: function(data) {
            $("#d-employee-id").text(data.employee_id)
            $("#d-employee-payroll-id").text(data.employee_payroll_id)
            $("#d-department").text(data.department)
            $("#d-company").text(data.company)
            $("#d-area").text(data.area)
            $("#d-employee-name").text(data.employee_name)
            $("#d-head").text(data.head)
            $("#d-email").text(data.email)
            $("#d-join-date").text(data.join_date)
            $("#d-level").text(data.level)
            $("#d-status").text(data.status)
            $("#d-resign-date").text(data.resign_date)
            mApp.unblock("#mal-table")
            modalDetail.modal({backdrop: 'static', keyboard: false})
        },
        statusCode: {
            500: function() {
                toastr.error("Terjadi kesalahan pada server.", "View Detail Failed!",{
                    "closeButton": "true"
                })
                mApp.unblock("#mal-table")
            }
        }
    })
}