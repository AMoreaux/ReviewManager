$("#asc_btn").click(function(){

    $("#demo-tbl tbody.sort").jSort({
        sort_by: 'td.code',
        item: 'tr',
        order: 'asc'
    });
});