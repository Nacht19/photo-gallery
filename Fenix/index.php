<!-- sinaliza que o arquivo sera programado em HTML -->
<!DOCTYPE html>
<!-- diz a lingua que sera usada nesse HTML -->
<html lang="pt-BR">
<!--  cabeçalho(no cabeçalho informaos qual tipo de arquivo a pagina pode receber, indeticação do site, -->
<!-- no cabeçalho tambem é feito a autenticação, titulo da pagina -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- titulo da pagina -->
    <title>Calculadora</title>
    <!-- alterar o estilo da pagina -->
    <style>
       * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

/* Estilo do corpo */
body {
    background: linear-gradient(135deg, #3d7dcbff, #165a6fff);
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Container da calculadora */
form {
    background: #2c3e50;
    padding: 20px 30px;
    border-radius: 12px;
    box-shadow: 0px 8px 18px rgba(0, 0, 0, 0.3);
    text-align: center;
}

/* Título */
h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #ecf0f1;
}

/* Labels */
label {
    font-weight: bold;
    display: block;
    margin-bottom: 8px;
    color: #ecf0f1;
}

/* Inputs */
input[type="number"], input[type="text"] {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: none;
    margin-bottom: 15px;
    outline: none;
    font-size: 16px;
}

/* Botões */
button {
    background: #27ae60;
    color: white;
    border: none;
    padding: 10px 18px;
    margin: 6px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #1e8449;
    transform: scale(1.05);
}

/* Resultado */
h4 {
    margin-top: 20px;
    text-align: center;
}

#resultado {
    margin-top: 10px;
    padding: 12px;
    background: #34495e;
    border-radius: 8px;
    text-align: center;
    font-weight: bold;
    font-size: 18px;
    color: #f1c40f;
}
    </style>
</head>
<!-- corpo da pagina(no body é onde vao as informações que aparecem para o usuario) -->
<body>
    <!-- cria um formulario( e isto é util para a organização do programador) -->
    <form>
        <!-- titulo da pagina tamanho(1,2,3,4,5 ou 6) -->
        <h2>Calculadora básica</h2><br>
        <!-- é o texto que botamos em tela e esta relacionado a um INPUT -->
        <label for="num1">Informe o 1° número</label>
        <!-- input é o local que botamos em tela direcionado para o usuario digitar  -->
        <input id="num1" type="number"> <br> <br>
        <label for="num2">Informe o 2° número</label>
        <input id="num2" type="number"> <br><br>
        <!-- criar um botão em tela -->
        <button type="button" onclick="calcular('somar')">Somar</button>
        <button type="button" onclick="calcular('subtrair')">Subtrair</button>
        <button type="button" onclick="calcular('multiplicar')">Multiplicar</button>
        <button type="button" onclick="calcular('dividir')">Dividir</button>
        <!-- br pula linhas -->
        <br><br>
        <h4>Resultado:</h4>
        <!-- div é uma partição nomeada da tela -->
        <div id="resultado"></div>
        <hr>
        <br><br>
        <label for="pokemon">Informe o pokemon</label>
        <input id="pokemon" type="text"> <br><br>
         <button type="button" onclick="inserirPokemon()">Inserir</button>
        <div id="pokemon-info"></div>
        <div id="cat-info"></div>
    </form>
    <script>
        function inserirPokemon(){
        // parte do código que faz a chamada da API
                var pokemon = document.getElementById('pokemon').value;
                fetch('https://pokeapi.co/api/v2/pokemon/'+pokemon)
                
                // diz que a reposta vai ser retornada em formato JSON
                .then(res => res.json())
                // Local onde posso manipular a resposta da API
                .then(data => {
                    console.log(data)
                    document.getElementById('pokemon-info').innerHTML = 'nome: '+ data.name
                    document.getElementById("pokemon-info").innerHTML += 
                    '<br><img src="'+data.sprites.front_default +'" width="150">';
        
                })
        }
        function calcular(operacao){
            // pegar os valores dos inputs que estao em tela através do ID
            // parseFloat transforma o valor em numero com casa decimal
            var numero1 = parseFloat(document.getElementById('num1').value);
            var numero2 = parseFloat(document.getElementById('num2').value);
                
            // escolha caso
            switch(operacao){
                // caso
                case 'somar':
                    resultado = numero1 + numero2;
                    //pare
                    break
                case 'subtrair':
                    resultado = numero1 - numero2;
                    break
                case 'multiplicar':
                    resultado = numero1 * numero2;
                    break
                case 'dividir':
                    // se numero 2 for diferente de 0
                    if(numero2 != 0){
                        resultado = numero1 / numero2;
                    }else{
                        resultado = 'Impossível dividir por zero';
                    }
                    break
            }
            // mostrar o resultado em tela
            document.getElementById('resultado').innerHTML =  resultado;
              fetch('https://pokeapi.co/api/v2/pokemon/'+resultado)
                
                // diz que a reposta vai ser retornada em formato JSON
                .then(res => res.json())
                // Local onde posso manipular a resposta da API
                .then(data => {
                    console.log(data)
                    document.getElementById('pokemon-info').innerHTML = 'nome: '+ data.name
                    document.getElementById("pokemon-info").innerHTML += 
                    '<br><img src="'+data.sprites.front_default +'" width="150">';
        
                })
                 .catch(error => {
        
            callCat();
        })

        .finally(() => {
            console.log('Processo Finalizado')
        
        })
        
        
        }           
        function callCat(){
        fetch("https://api.thecatapi.com/v1/images/search")
            .then(res => res.json())
            .then(data => {
                console.log(data)
                document.getElementById('cat-info').innerHTML = '<br><img src="'+data[0].url + '"width="150">'
                
            })    
        }
    </script>