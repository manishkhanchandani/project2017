<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.95.1/css/materialize.min.css">

<div class="container">
  <div class="row">
    <nav>
      <div class="nav-wrapper">
        <div class="col s12">
          <a href="#" class="brand-logo">Text to speech example</a>
        </div>
      </div>
    </nav>
  </div>
  <form class="col s8 offset-s2">
    <div class="row">
      <label>Choose voice</label>
      <select id="voices"></select>
    </div>
    <div class="row">
      <div class="col s6">
        <label>Rate</label>
        <p class="range-field">
          <input type="range" id="rate" min="1" max="100" value="10" />
        </p>
      </div>
      <div class="col s6">
        <label>Pitch</label>
        <p class="range-field">
          <input type="range" id="pitch" min="0" max="2" value="1" />
        </p>
      </div>
      <div class="col s12">
        <p>N.B. Rate and Pitch only work with native voice.</p>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <textarea id="message" class="materialize-textarea"></textarea>
        <label>Write message</label>
      </div>
    </div>
    <a href="#" id="speak" class="waves-effect waves-light btn">Speak</a>
  </form>  
</div>

<div id="modal1" class="modal">
  <h4>Speech Synthesis not supported</h4>
  <p>Your browser does not support speech synthesis.</p>
  <p>We recommend you use Google Chrome.</p>
  <div class="action-bar">
    <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Close</a>
  </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.95.1/js/materialize.min.js"></script>
<script src="speechtoText.js"></script>