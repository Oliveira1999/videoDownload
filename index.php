<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DLoader</title>
  <!-- Fonte -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&display=swap" rel="stylesheet">
  <!-- Estilos -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <!-- Scripts (jQuery não pode ser o slim que vem do Boostrap) -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/bf7e05c402.js" crossorigin="anonymous"></script>
  <!-- Moment.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-duration-format/2.3.2/moment-duration-format.min.js"></script>
</head>

<style>
    .rating-container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 30px;
    }

    .rating {
      display: flex;
  flex-direction: row-reverse;
  justify-content: center;
    }

    .rating > input {
      display: none;
    }

    .rating > label {
      position: relative;
      width: 1em;
      font-size: 3rem;
      color: #ddd; /* Cor inicial das estrelas não selecionadas */
      cursor: pointer;
    }

    .rating > label::before {
      content: "\2605";
      position: absolute;
      display: block;
    }

    .rating > input:checked ~ label {
      color: #FFD700; /* Cor das estrelas selecionadas */
    }

    .rating:not(:checked) > label:hover,
    .rating:not(:checked) > label:hover ~ label {
      color: #FFD700; /* Cor das estrelas ao passar o mouse */
    }

    .rating > input:checked + label:hover,
    .rating > input:checked + label:hover ~ label,
    .rating > input:checked ~ label:hover,
    .rating > input:checked ~ label:hover ~ label,
    .rating > label:hover ~ input:checked ~ label {
      color: #FFD700; /* Cor das estrelas selecionadas ao passar o mouse */
    }
  </style>
<body>
  <header>
    <div class="container" id="nav-container">
      <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
      <a class="navbar-brand" href="#" style="color:#000">
  <img id="logo" src="img/2n.png" alt="DLoader" style="width: 120px;">
  
</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-links" aria-controls="navbar-links" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbar-links">
       <!-- <div class="navbar-nav mr-auto">-->
        <!-- Seletor de cor -->
       <!-- <input type="color" id="navbar-color-picker" value="#343a40" style="margin-left: 800px;">-->
        <!-- Botão para aplicar a cor -->
        
     <!-- </div>-->
          <div class="navbar-nav text-nav">
            <a class="nav-item nav-link" data-toggle="modal" data-target="#modal-dloader" id="home-menu" href="#">DLoader</a>
            <a class="nav-item nav-link" id="contact-menu" data-toggle="modal" data-target="#modal-contato" href="#">Contato</a>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div class="form-container">
    <form id="video-form" style="border: none;" method="post">
      <div class="form-group d-flex">
        <input type="text" class="form-control form-control-lg flex-grow-1 mr-2" style="border-style: outset;" id="video-url" placeholder="Cole o link aqui">
        <button type="submit" class="btn btn-lg" style="color:#FF3131;background-color:#fff"><i class="fas fa-check"></i></button>
      </div>
    </form>
  </div>

 

  <div class="card" id="video-card">
    <div class="card-body d-flex">
      <div class="flex-grow-1">
        <h5 class="card-title" id="video-title"></h5>
        <a href="#" id="video-link" target="_blank" style="display: none; color: #FF0000;"><i class="fab fa-youtube"></i> Assistir ao Vídeo no YouTube</a> <!-- Novo elemento de link -->
        <div class="d-flex align-items-start">
          <img id="video-thumbnail" class="img-fluid mr-3" src="" alt="Thumbnail do vídeo">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Ficheiro</th>
                <th>Tamanho</th>
                <th>Download</th>
              </tr>
            </thead>
            <tbody>
          
                <td>MP3 (Áudio)</td>
                <td id="audio-size"></td>
                <td><button type="button" id="download-audio" class="btn btn-outline-danger btn-lg btn-block"><i class="fas fa-download"></i> Baixar Áudio</button></td>
              </tr>
            </tbody>
          </table>
        </div>
        <p class="card-text" id="video-description"></p>
      </div>
    </div>
    <!-- Barra de progresso -->
    <div class="progress" id="progress" style="margin-top: 10px; margin-bottom: 5px; display: none;">
      <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <!-- Mensagem de aguarde -->
    <div id="loading-message" class="text-center mt-2" style="display: none;">
      <i class="fas fa-spinner fa-spin fa-2x"></i>
      <p>Aguarde um momento...</p>
    </div>
    <!-- Mensagem de download concluído -->
    <div id="downloaded-message" class="alert alert-success text-center mt-2" style="display: none;">
      <strong>Download concluído!</strong>
    </div>
  </div>

   <!-- Container centralizado com cards -->
<!-- Container centralizado com cards -->
<div class="d-flex justify-content-center mt-4">
  <div class="card-deck" id="card-info">
    <div class="card border-secondary bg-dark text-white mb-3" style="max-width: 18rem;">
      <div class="card-header"><i class="fas fa-link" style="color: #ff9900; font-size: 2em;"></i> Passo 1</div>
      <div class="card-body">
        <h5 class="card-title">Cole o Link</h5>
        <p class="card-text text-white">Cole o link do vídeo do YouTube no campo acima.</p>
      </div>
    </div>
    <div class="card border-secondary bg-dark text-white mb-3" style="max-width: 18rem;">
      <div class="card-header"><i class="fas fa-search" style="color: #33cc33; font-size: 2em;"></i> Passo 2</div>
      <div class="card-body">
        <h5 class="card-title">Busque o Vídeo</h5>
        <p class="card-text text-white">Clique no botão para buscar o vídeo e exibir as informações.</p>
      </div>
    </div>
    <div class="card border-secondary bg-dark text-white mb-3" style="max-width: 18rem;">
      <div class="card-header"><i class="fas fa-download" style="color: #ff3300; font-size: 2em;"></i> Passo 3</div>
      <div class="card-body">
        <h5 class="card-title">Baixe o Áudio</h5>
        <p class="card-text text-white">Clique no botão de download para baixar o áudio do vídeo.</p>
      </div>
    </div>
  </div>
</div>
<div class="container mt-4 text-center" style="display:none">
  <h5>Por favor, avalie nosso site:</h5>
  <p class="mt-2">Sua avaliação: <span id="rating-value">0</span></p>
  <div class="rating">
    <input type="radio" id="star6" name="rating" value="6">
    <label for="star6"></label>
    <input type="radio" id="star5" name="rating" value="5">
    <label for="star5"></label>
    <input type="radio" id="star4" name="rating" value="4">
    <label for="star4"></label>
    <input type="radio" id="star3" name="rating" value="3">
    <label for="star3"></label>
    <input type="radio" id="star2" name="rating" value="2">
    <label for="star2"></label>
    <input type="radio" id="star1" name="rating" value="1">
    <label for="star1"></label>
  </div>
 
</div>


  <footer class="d-flex justify-content-center align-items-center">
    <p class="mb-0"  style="color: #000; ">&copy; 2024 DLoader. Todos os direitos reservados.</p>
    <a href="#" data-toggle="modal" data-target="#modal-politica" style="color: #000; font-size: 15px; text-decoration: underline; margin-left: 10px;">Política de Privacidade</a>
 
  </footer>

   <!-- MODAL DLOADER -->
 <div class="modal fade" id="modal-dloader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">DLoader</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
    <a class="navbar-brand" href="#" style="color:#000">
  <img id="logo" src="img/2n.png" alt="DLoader" style="width: 150px;">
  
</a>
<h6>Objetivo do Site</h6>
          <p>Nosso objetivo é criar uma plataforma abrangente e acessível que permita aos
          utilizadores baixar e desfrutar de músicas e vídeos de maneira fácil, rápida e segura.</p>


          <h6>Missão</h6>
          <p>Nossa missão é proporcionar uma experiência de download fluida e eficiente, oferecendo uma vasta biblioteca de conteúdo musical e, futuramente, expandindo para incluir uma coleção diversificada de vídeos.
             Queremos ser a plataforma de escolha para os amantes da música e do vídeo que buscam qualidade, conveniência e uma interface amigável.</p>

             <h6>Visão</h6>
          <p>Nosso site aspira ser reconhecido como uma referência líder no fornecimento de downloads 
            de mídia digital, integrando tecnologia de ponta e inovação contínua para atender às necessidades em constante evolução dos nossos usuários.</p>
<hr>
             <h6>Funcionalidades Atuais</h6>
          <p><strong>Download de Música:</strong> Proporcionar uma vasta seleção de músicas de diferentes gêneros e artistas, permitindo aos usuários baixar suas faixas favoritas com facilidade.
<br>
<strong>Interface Amigável:</strong> Um design intuitivo e fácil de usar, garantindo que mesmo os usuários menos experientes possam navegar e encontrar o conteúdo desejado sem complicações.
<br><strong>Qualidade e Segurança: </strong>Garantir que todos os downloads sejam de alta qualidade e livres de qualquer tipo de malware ou ameaça à segurança do usuário.</p>

          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

 
 <!-- MODAL POLÍTICA -->
 <div class="modal fade" id="modal-politica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Política de Privacidade</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
    <a class="navbar-brand" href="#" style="color:#000">
  <img id="logo" src="img/2n.png" alt="DLoader" style="width: 120px;">
  
</a>
          <p>Bem-vindo ao DLoader. Respeitamos sua privacidade e estamos comprometidos em protegê-la.
             Esta Política de Privacidade descreve nossas práticas de privacidade, 
            explicando que não coletamos nenhuma informação pessoal dos utilizadores  que visitam e utilizam nosso Site para download.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL CONTATO -->
  <div class="modal fade" id="modal-contato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Contato</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="envio.php">>
            <div class="form-group">
              <label for="name">Nome:</label>
              <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="message">Mensagem:</label>
              <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name ="email">Enviar Mensagem</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts personalizados -->
  <script src="js/main.js"></script>
</body>
</html>

  <script>
    const API_KEY = 'AIzaSyC7TMz0gFDq6OOSak_Q94SlmMsfgqGgwI8';

       // Função para buscar e exibir informações do vídeo quando o formulário é enviado
       function searchVideo() {
      const videoUrl = $('#video-url').val();
      const videoId = getYouTubeVideoId(videoUrl);
      if (videoId) {
        fetchYouTubeVideo(videoId);
      } else {
        alert('Link do vídeo inválido');
      }
    }


    // Função para obter o ID do vídeo do YouTube
    function getYouTubeVideoId(url) {
      const urlObj = new URL(url);
      return urlObj.searchParams.get('v');
    }

    function fetchYouTubeVideo(videoId) {
  $.ajax({
    url: `https://www.googleapis.com/youtube/v3/videos?id=${videoId}&key=${API_KEY}&part=snippet,contentDetails`,
    method: 'GET',
    success: function(response) {
      if (response.items.length > 0) {
        const video = response.items[0];
        const snippet = video.snippet;
        const duration = moment.duration(video.contentDetails.duration).asSeconds();

        $('#video-title').text(snippet.title);
        $('#video-thumbnail').attr('src', snippet.thumbnails.high.url);
        $('#video-card').show();
        $('#card-info').hide();

        // Adicionar link do vídeo
        const videoUrl = `https://www.youtube.com/watch?v=${videoId}`;
        $('#video-link').attr('href', videoUrl).show();

        calculateMP3FileSize(duration);

        $('#download-audio').data('href', `baixarAudio.php?videoIdAudio=${videoId}`); // Adiciona link para baixar áudio
      } else {
        alert('Vídeo não encontrado');
      }
    },
    error: function() {
      alert('Erro ao buscar o vídeo');
    }
  });
}




    // Função para calcular o tamanho do arquivo MP3
function calculateMP3FileSize(duration) {
  // Considerando um bitrate médio para MP3 (em kbps - kilobits por segundo)
  const mp3Bitrate = 128; // Exemplo de bitrate em kbps para MP3

  // Convertendo o bitrate de kbps para MB
  const sizeInMegabytes = (mp3Bitrate * duration) / (8 * 1024); // Convertendo para MB

  $('#audio-size').text(sizeInMegabytes.toFixed(2) + ' MB'); // Tamanho aproximado do arquivo de MP3
}


 
 
    // Evento de input no campo de URL para esconder o card se o campo estiver vazio
    $('#video-url').on('input', function() {
      if (!$(this).val()) {
        $('#video-card').hide();
        $("#card-info").show();
      } else {
        searchVideo();
      }
    });


    // Evento de clique no botão de download de áudio
    $('#download-audio').click(function(e) {
      e.preventDefault();
      var audioUrl = $(this).data('href');
      var videoTitle = $('#video-title').text(); // Obtém o título do vídeo
      startDownload(audioUrl, `${videoTitle}.mp3`);
    });


function startDownload(url, filename) {
  // Mostra mensagem de "Aguarde um momento"
  $('#progress').show();
  $('#loading-message').show();
  // Esconde mensagem de "Download concluído" e reseta a barra de progresso
  $('#downloaded-message').hide();
  $('#progress-bar').addClass('progress-bar-animated').css('width', '0%').text('0%');

  var xhr = new XMLHttpRequest();
  xhr.open('GET', url, true);
  xhr.responseType = 'blob';

  xhr.onprogress = function(e) {
    if (e.lengthComputable) {
      var percentComplete = (e.loaded / e.total) * 100;
      // Arredonda a porcentagem para o múltiplo de 20 mais próximo
      var roundedPercent = Math.floor(percentComplete / 20) * 20;
      $('#progress-bar').css('width', roundedPercent + '%');
      $('#progress-bar').attr('aria-valuenow', roundedPercent);
      $('#progress-bar').text(roundedPercent.toFixed(2) + '%');
    }
  };

  xhr.onload = function() {
    if (this.status === 200) {
      var blob = new Blob([this.response], { type: 'video/mp4' });
      var downloadUrl = window.URL.createObjectURL(blob);
      var a = document.createElement('a');
      a.style.display = 'none';
      a.href = downloadUrl;
      a.download = filename;
      document.body.appendChild(a);
      a.click();
      window.URL.revokeObjectURL(downloadUrl);

      // Esconde mensagem de "Aguarde um momento" e mostra "Download concluído"
      $('#loading-message').hide();
      $('#downloaded-message').show();

      // Remove a classe de animação da barra de progresso ao concluir o download
      $('#progress-bar').removeClass('progress-bar-animated');
    }
  };

  xhr.send();
}


  </script>
</body>
</html>

