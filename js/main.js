jQuery(function($) {
   $("a.edit").click(function(e) {
      e.preventDefault();
      var href = $(this).attr("href");
      window.open(href, "Editer", "menubar=no, status=no, scrollbars=yes, menubar=no, width=550, height=400");
   })

   //
   $("#cancel").click(function(e) {
      e.preventDefault();
      window.close();
   })

   //
   $("a.del").click(function(e) {
      e.preventDefault();
      if (confirm("Voulez-vous supprimer la ligne ?")) { // Clic sur OK
         var href = $(this).attr("href");
         document.location.href = href;
      } else {
         exit(0);
      }
   })

   //Spp
   $("a.remove").click(function(e) {
      e.preventDefault();
      if (confirm("Voulez-vous supprimer la ligne ?")) { // Clic sur OK
         var href = $(this).attr("href");
         var ids = $("#liste input:checked").serialize();
         var reg = new RegExp("(del)", "g");
         ids = ids.replace(reg, "del[]");
         href = href + ids;
         document.location.href = href;
      } else {
         exit(0);
      }
   })

//CheckAll
   $('#checkAll').on('click', function() {
      $('tbody').find(':checkbox').prop('checked', this.checked);
   });
});
