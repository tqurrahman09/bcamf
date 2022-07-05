<script>
	$('#i-btn-print').click(function(event) {
        /* Act on the event */
        var printContent = document.getElementById('print-area');
        var WinPrint = window.open('', '', 'width=900,height=650');
        WinPrint.document.write(printContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    })
</script>