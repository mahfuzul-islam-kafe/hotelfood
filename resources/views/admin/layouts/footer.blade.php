</div>
    </div>
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- DataTables SearchPanes JS -->
<script src="https://cdn.datatables.net/searchpanes/1.3.0/js/dataTables.searchPanes.min.js"></script>
<!-- DataTables Select JS -->
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<!-- DataTables Buttons HTML5 Export JS -->
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    $('.data-tables').DataTable({
        dom: 'lBfrtipP', // Adding 'l' for search input
        buttons: [
            'copy', 'excel', 'pdf'
        ],
        searchPanes: true,
        select: true
    });
});
</script>

</body>
</html>