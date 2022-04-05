<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <!--
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--Fonts--> 
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!--Styles--> 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--Alpine js -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <!--Tailwind --> 
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tom -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet"/> 

    <!-- Select2 -->
    <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->

    @livewireStyles
    <style>
        [x-cloak] { 
            display: none !important;
        }
    </style>
</head>
<body x-cloak x-data="{openModal: false}"
 :class="openModal ? 'overflow-hidden' : 'overflow-visible'" > <!-- junto ao x-cloack no style evita com que os madais abram ao carregar a pagina -->

    {{  $slot }}
    @livewireScripts

    <!-- Tom -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script>
      const tomSelectMultiple = new TomSelect('#select-role', {
        plugins: {
            'clear_button':{
              'title':'Remover todas as opções selecionadas',
                
            },
            'remove_button':{
			        'title':'Remover esse time',
		        }
        },
        onDelete: function(values) {
		    return confirm(values.length > 1 ? 'Are you sure you want to remove these ' + values.length + ' items?' : 'Are you sure you want to remove "' + values[0] + '"?');
	      },
        persist: false,
        create: true,
        //preload: true,
      });

      document.getElementById('resetSelect').onclick = function() {
        tomSelectMultiple.clear();
      };

    </script> <!-- responsavel por manter um numero max de options sendo selecionadas caso necessario // também cria o botão de delete para remover todos os selects-->

    <!--</script>-->
</body>
</html>