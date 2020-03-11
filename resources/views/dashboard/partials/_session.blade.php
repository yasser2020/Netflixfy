@if (session('success'))
<script>
    new Noty({
        type:'alert alert-info',
    layout:'topRight',
    text: "{{session('success')}}",
    timeout:2000,
    killer:true,

}).show();

</script>
    
@endif