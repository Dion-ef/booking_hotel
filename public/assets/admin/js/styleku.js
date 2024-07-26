const menu = document.getElementById('bars');
 const sidebar = document.getElementsByClassName('sidebar-container')[0];
 const navbar = document.getElementById('navbar');

 menu.addEventListener('click', function(){
    sidebar.classList.toggle('hide');
    navbar.classList.toggle('hide')
 })

 $(document).ready(function() {
   var url = window.location.href;
   $('.sidebar li').each(function() {
       if (url === (this.href)) {
           $(this).addClass('active');
       }
   });
});