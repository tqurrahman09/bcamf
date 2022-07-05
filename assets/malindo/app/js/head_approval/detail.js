var detail_ = function(id){
    $.ajax({
        url: baseUrl + "head_approval/ajax_detail",
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
            $("#d-employee-name").text(data.employee_name)
            $("#d-head-name").text(data.head_name)
            $("#d-leave-dates").text(data.leave_dates)
            $("#d-purpose").text(data.purpose)
            $("#d-job").text(data.job)
            $("#d-job-delegation").text(data.job_delegation)
            $("#d-type").text(data.type)
            $("#d-status").text(data.status)
            $("#d-submit-date").text(data.submit_date)
            $("#d-head-decided-by").text(data.head_decided_by)
            $("#d-head-decided-date").text(data.head_decided_date)
            $("#d-hrd-decided-by").text(data.hrd_decided_by)
            $("#d-hrd-decided-date").text(data.hrd_decided_date)
            $("#d-note").text(data.note)
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