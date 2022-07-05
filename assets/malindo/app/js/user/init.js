var InitJs = {
    init:function() {
        table = $("#mal-table").DataTable( {
            responsive:!0,
            searchDelay:500, 
            pagingType:"full_numbers",
            processing: !1,
            serverSide: !0,
            order: [],
            ajax: {
                url: baseUrl + "user/ajax_list",
                type: "POST"
            },
            columnDefs: [
                {
                    targets: -1,
                    orderable: !1
                },
                {
                    targets: 0,
                    orderable: !1,
                    searchable: !1
                },
                {
                    targets: -2,
                    orderable: !1,
                    searchable: !1
                },
                {
                    targets: -3,
                    orderable: !1,
                    searchable: !1
                }
            ]
            // columnDefs: [{
            //     targets: 0,
            //     render: function(a, n, e, s) {
            //         var t = mUtil.getRandomInt(1, 14);
            //         return t > 8 ? '\n<div class="m-card-user m-card-user--sm">\n<div class="m-card-user__pic">\n<img src="' + a + '" class="m--img-rounded m--marginless" alt="photo">\n</div>\n<div class="m-card-user__details">\n<span class="m-card-user__name">' + e[2] + '</span>\n<a href="" class="m-card-user__email m-link">' + e[3] + "</a>\n</div>\n</div>" : '\n<div class="m-card-user m-card-user--sm">\n<div class="m-card-user__pic">\n<div class="m-card-user__no-photo m--bg-fill-' + ["success", "brand", "danger", "accent", "warning", "metal", "primary", "info"][mUtil.getRandomInt(0, 7)] + '"><span>' + e[2].substring(0, 1) + '</span></div>\n</div>\n<div class="m-card-user__details">\n<span class="m-card-user__name">' + e[2] + '</span>\n<a href="" class="m-card-user__email m-link">' + e[3] + "</a>\n</div>\n</div>"
            //     }
            // }]
        }
        )
    }
};
jQuery(document).ready(function() {
    InitJs.init()
}

);