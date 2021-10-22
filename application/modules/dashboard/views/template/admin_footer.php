  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="#">Minor Coffee</a>.</strong>
  </footer>


<!-- jQuery -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- pace-progress -->
<script src="<?php echo base_url('assets/plugins/pace-progress/pace.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/dist/js/demo.js')?>"></script>

<!------- AJAX SEARCH AUTOCOMPLETE ------->
<script src="<?= base_url('assets/dist/js/autocomplete/handlebars.js')?>"></script>
<script src="<?= base_url('assets/dist/js/autocomplete/typeahead.bundle.js')?>"></script>
<script>
  $(document).ready(function(){
    var sample_data = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch:'<?= base_url(); ?>dashboard/fetch',
      remote:{
        url:'<?= base_url(); ?>dashboard/fetch/%QUERY',
        wildcard:'%QUERY'
      }
    });


    $('#prefetch .typeahead').typeahead(null, {
      name: 'sample_data',
      display: 'name',
      source:sample_data,
      limit:10,
      templates:{
        suggestion:Handlebars.compile(
          '<div id="search-show" class="row mx-auto p-2 shadow"><div class="col-md-3" style="padding-right:5px; padding-left:5px;"><img src="<?= base_url()?>gambar/{{image}}" class="img-thumbnail" width="48" /></div><div class="col-md-9"><span class="font-weight-bold text-dark">{{name}}</span><br><small class="font-italic text-dark">Rp. {{price}},-</small></div></div>'
          )
      }
    });
  });
</script>


<script>
function openPills(cityName) {
  var i;
  var x = document.getElementsByClassName("pills");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(cityName).style.display = "block";
}
</script>
<script>
    $(document).ready(function() {
        // Untuk sunting
        $('#edit-kategori').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal          = $(this)

            // Isi nilai pada field
            modal.find('#cat_id').attr("value",div.data('cat_id'));
            modal.find('#cat_name').attr("value",div.data('cat_name'));
        });
    });
</script>
</body> 
</html>