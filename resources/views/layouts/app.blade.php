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
      //edit multipleSelect
      /*var tomEditMultiple = new TomSelect('#edit-role', {
        maxItems: null,
        valueField: 'id',
        labelField: 'title',
        searchField: 'title',
        //AttributeField: 'attribute',
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
            preload: true,
            create: true,
            //preload: true,
        });*/

      /*window.livewire.on('resetSelect', () => {
        tomSelectMultiple.clear();
      });*/

      document.getElementById('resetSelect').onclick = function() {
        tomSelectMultiple.clear();
      };

    window.livewire.on('selectLoadOk', ($timesSelected) =>{
      for($cont = 0;$cont < $timesSelected.length; $cont++) 
      {	
        option = tomEditMultiple.addOption({id:$timesSelected[$cont].id, title: $timesSelected[$cont].nome});//.setValue('selected'); // adiciona a option a list de options
        console.log(option);
        console.log(tomEditMultiple.getOption($timesSelected[$cont].id, false));
        //option = tomEditMultiple.addOption({id:15185, title: 'xxxxxxxxxxxxxxxxx'});//.setValue('selected');
        tomEditMultiple.refreshOptions();
        console.log($timesSelected[$cont].nome);
        //tomEditMultiple.setValue($timesSelected[$cont].id, silent);
        //option2 = tomEditMultiple.addItem([$timesSelected[$cont].nome]);
        console.log(tomEditMultiple.getOption(1));
        //console.log(option2);
        $message = "*[data-value=" + '"' + '1' + '"]' + "";
        console.log($message);
        //var select = document.querySelector($message);
        //var select = document.querySelector('[id="edit-role-opt-3"]');
        //var select = document.getElementsByClassName('ts-control')[1].appendChild(document.querySelector($message));
        //var select = document.getElementById('edit-role-opt-3');
        
        var select = document.getElementsByClassName('ts-dropdown ')[0].appendChild(document.querySelector($message));

        console.log(select);
        console.log('depois');

        //document.getElementsByClassName('ts-control')[1].appendChild(select); // insere a nova option dentro do input que exibe as options selecionadas para os times já presentes no campeonato
        
        //document.getElementById('edit-role')[1].appendChild(select);
        
        var select = document.getElementsByClassName('ts-dropdown');
        console.log(select);
        //var teste = document.querySelector('*[data-value="X"]');
        //document.getElementsByClassName('ts-control')[1].appendChild(teste);

        /*var inputSelect = document.querySelectorAll('input[type="select-multiple"]')[1]; // essa e as prox 2 linhas servem para alterar a posição do input que diz "Editar times", passando ele para depois dos inputs dos times selecionados que foram adicionados nesse código
        document.querySelectorAll('input[type="select-multiple"]')[1].remove;
        document.getElementsByClassName('ts-control')[1].appendChild(inputSelect);*/

      }
      tomEditMultiple.refreshItems();
      var val = tomEditMultiple.getOption(1);
      console.log(val);
      document.getElementsByClassName('ts-control')[1].appendChild(tomEditMultiple.getOption(1));
      console.log('triste');
      //testando a criação das divs manualmente
      var divEl = document.createElement("div");
      var textEl = document.createTextNode("Meu texto vai aqui");
      divEl.appendChild(textEl);
      divEl.setAttribute('data-value', 'P');
      divEl.setAttribute('class', 'item');
      divEl.setAttribute('data-ts-item', '');
      var divEl2 = document.createElement("a")
      var textEl = document.createTextNode("×")
      divEl2.appendChild(textEl);
      divEl2.setAttribute('href', 'javascript:void(0)');
      divEl2.setAttribute('class', 'remove');
      divEl2.setAttribute('tabindex', -1);
      divEl2.setAttribute('title', 'Remover esse time');
      divEl.appendChild(divEl2);
      document.getElementsByClassName('ts-control')[1].appendChild(divEl)
      var divEl = document.createElement("option");
      var textEl = document.createTextNode("P");
      divEl.appendChild(textEl);
      divEl.setAttribute('value', 'P');
      divEl.setAttribute('selected', '');
      document.getElementById('edit-role').appendChild(divEl);
      //document.getElementsByClassName('ts-control')[1].append("<button>Outro Botão adicionado</button>");
      var inputSelect = document.querySelectorAll('input[type="select-multiple"]')[1]; // essa e as prox 2 linhas servem para alterar a posição do input que diz "Editar times", passando ele para depois dos inputs dos times selecionados que foram adicionados nesse código
      document.querySelectorAll('input[type="select-multiple"]')[1].remove;
      document.getElementsByClassName('ts-control')[1].appendChild(inputSelect);
      //tomEditMultiple.addItem('test');
      //tomEditMultiple.sync();
      tomEditMultiple.refreshItems();
      //tomEditMultiple.removeOption(1);
      /*tomEditMultiple.destroy()
      tomEditMultiple = new TomSelect('#edit-role', {
        maxItems: null,
        valueField: 'id',
        labelField: 'title',
        plugins: {
          'clear_button':{
          'title':'Remover todas as opções selecionadas',
            
          },
          'remove_button':{
              'title':'Remover esse time',
            }
        },
        options: [ 
          {id: 1, title: 'Spectrometer'},
          {id: 2, title: 'Star Chart'},
          {id: 3, title: 'Electrical Tape'}
        ],
        onDelete: function(values) {
          return confirm(values.length > 1 ? 'Are you sure you want to remove these ' + values.length + ' items?' : 'Are you sure you want to remove "' + values[0] + '"?');
        },
        persist: false,
        create: true,
        //preload: true,
          });*/
      //tomEditMultiple.addItem('test');
      alert('aaa');
	  });

    window.livewire.on('tiraSelected', ($timesSelected) =>{
      for($cont = 0;$cont < $timesSelected.length; $cont++) 
      {
        //option = tomEditMultiple.addOption({id:$timesSelected[$cont].id, title: $timesSelected[$cont].nome});
        const option = new Option($timesSelected[$cont].nome, $timesSelected[$cont].id, false, true);
        $('#edit-role').append(option).trigger('change');
        console.log(tomEditMultiple.getItem(option));
      }
    });
    </script> <!-- responsavel por manter um numero max de options sendo selecionadas caso necessario // também cria o botão de delete para remover todos os selects-->

    <!--</script>-->
</body>
</html>