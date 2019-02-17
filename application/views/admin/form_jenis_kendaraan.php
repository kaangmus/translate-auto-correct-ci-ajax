        <style type="text/css">
            .testClick:hover{
                cursor: pointer;
            }

        </style>
        <div class="content">
            <div class="container-fluid">
                <div class="row" id="app">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Indonesia</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Dalam Bahasa Indonesia</label>
                                                <textarea id="thing" rows="5" class="form-control" placeholder="Ketikkan kata disini" value="Mike"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="formname"></h4>
                                    
                                    <div class="clearfix"></div>
                                </form>
                                <div id="spell"></div>
                            </div>
                        </div>
                    </div>
 <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">English</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>In English Language</label>
                                                <textarea rows="5" class="form-control terjemahkan" placeholder="Result of translate" value="Mike"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
              
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Development by Musliadi | Universitas Ahmad Dahlan</a>
                </p>
            </div>
        </footer>

    
</div>
</div>
</div>
</div>

</div>
</div>
</div>
    <script src="<?php echo base_url();?>assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script>

$(function() {
  $('#app').keyup(function(e) {

    var formname = $(this).find('.formname');
 
 var words=  $(this).find('#thing').val();
      $.ajax({
        url : 'http://localhost/kamus2/index.php/kamus/sphell',
        method : "POST",
        data : {words: words},
        async : false,
            dataType : 'json',
        success: function(data){
                formname.html('<a  onclick="myFunction()" id="testClick" class="testClick" rel="'+data+'" >'+data +' ?  </a>');
        }
      });
  });
});


function myFunction() {
    var url=$('#testClick').attr("rel");
    $('#thing').val(url);
}

$(function() {
  $('#app').keyup(function(e) {

    var formnamee = $(this).find('.terjemahkan');
 
 var words=  $(this).find('#thing').val();
      $.ajax({
        url : 'http://localhost/kamus2/index.php/kamus/terjemahkan',
        method : "POST",
        data : {words: words},
        async : false,
            dataType : 'json',
        success: function(data){
                     formnamee.text(data['arti']);
                }

            
      });
  });

});


$(document).ready(function(){
    $('.formname').click(function(){
     var words=$('#testClick').attr("rel");
      var formnamee = $('.terjemahkan');
      $.ajax({
        url : 'http://localhost/kamus2/index.php/kamus/terjemahkan',
        method : "POST",
        data : {words: words},
        async : false,
            dataType : 'json',
        success: function(data){
                      formnamee.text(data['arti']);
        }
      });
    });
  });


</script>

