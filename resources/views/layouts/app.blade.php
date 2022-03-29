<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    
    <!--<script src="{{ asset('js/app.js') }}" defer></script>
     Fonts 
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
     Styles 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <script src="//unpkg.com/alpinejs" defer></script>
    @livewireStyles
</head>
<body>

    {{  $slot }}
    @livewireScripts
    <script>
        /*window.livewire.on('jogadorAdded',()=>{
            $('#addJogadorModal').modal('hide');
        })*/
        
        //teste
        window.livewire.on('closeModal', function(modalName){
            $(modalName).modal('hide');
            //$('#addJogadorModal').modal('hide');
        })  
        
        /*window.addEventListener('jogadorAdded', event => {
            $('#addJogadorModal').modal('hide');
        })*/ // esconde o model após criar o jogador ou oque estiver sendo criado
        //alert('ok');
        
        /*window.livewire.on('jogadorUpdated',()=>{
            $('#updateJogadorModal').modal('hide');
        })*/
        
        /*window.livewire.on('jogadorInfo',()=>{
            $('#infoJogadorModal').modal('hide');
        })*/

        /*window.livewire.on('jogadorInfo', event => {
            $('#infoJogadorModal').removeData('modal');
        })*/

        /*$('#modal-item').on('hidden', function() {
            $(this).removeData('modal');
        });*/

        /*$(function() {
            $(".modal-link").click(function(event) {
                event.preventDefault()
                $('#myModal').removeData("modal")
                $('#myModal').modal({remote: $(this).attr("href")})
            })
        })*/

    </script>
</body>
</html>