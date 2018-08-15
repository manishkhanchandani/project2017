var express = require('express');
var path = require('path');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var session = require('express-session');
var expressValidator = require('express-validator');
var flash = require('connect-flash');
var config = require('./config'); // get our config file
var morgan      = require('morgan');
//var jwt    = require('jsonwebtoken');
var admin = require("firebase-admin");
var serviceAccount = require("./project100-407c4cc964f3.json");
admin.initializeApp({
  credential: admin.credential.cert(serviceAccount),
  databaseURL: config.databaseURL
});
// Use the shorthand notation to retrieve the default app's services
var defaultAuth = admin.auth();
var defaultDatabase = admin.database();
var fbRef = defaultDatabase.ref(config.firebasePath);
var userRef = defaultDatabase.ref(config.firebaseUsersPath);

// Route Files
var routes = require('./routes/fb');

// Init App
var app = express();

// View Engine
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');
app.set('superSecret', config.secret); // secret variable
// Logger
app.use(logger('dev'));

// Body Parser
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());

// use morgan to log requests to the console
app.use(morgan('dev'));

// Handle Sessions
app.use(session({
  secret:'secret',
  saveUninitialized: true,
  resave: true
}));

// Validator
app.use(expressValidator({
  errorFormatter: function(param, msg, value) {
      var namespace = param.split('.')
      , root    = namespace.shift()
      , formParam = root;

    while(namespace.length) {
      formParam += '[' + namespace.shift() + ']';
    }
    return {
      param : formParam,
      msg   : msg,
      value : value
    };
  }
}));

// Static Folder
app.use(express.static(path.join(__dirname, 'public')));

// Connect Flash
app.use(flash());

// Global Vars
app.use(function (req, res, next) {
  res.locals.success_msg = req.flash('success_msg');
  res.locals.error_msg = req.flash('error_msg');
  res.locals.error = req.flash('error');
  //res.locals.authdata = defaultAuth.getAuth();
  res.locals.page = req.url;

  // Website you wish to allow to connect
  res.setHeader('Access-Control-Allow-Origin', '*');

  // Request methods you wish to allow
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');

  // Request headers you wish to allow
  res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');

  // Set to true if you need the website to include cookies in the requests sent
  // to the API (e.g. in case you use sessions)
  res.setHeader('Access-Control-Allow-Credentials', true);
  next();
});

// Get User Info
app.get('*', function(req, res, next){
  /*if(defaultAuth.getAuth() != null){
    //var userRef = new Firebase('https://project100-fe20e.firebaseio.com/prjServer/users/');
    userRef.orderByChild("uid").startAt(defaultAuth.getAuth().uid).endAt(defaultAuth.getAuth().uid).on("child_added", function(snapshot) {
      res.locals.user = snapshot.val();
    });
  }*/
  next();
});

// Routes
app.use('/', routes);
app.use('/', stratus);

// Set Port
app.set('port', (process.env.PORT || 5000));

// Run Server
app.listen(app.get('port'), function(){
  console.log('Server started on port: '+app.get('port'));
});
