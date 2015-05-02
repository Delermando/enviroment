var express = require('express')
    mongoose = require("mongoose");

var ip = process.env.MONGO_PORT_27017_TCP_ADDR;
var port = process.env.MONGO_PORT_27017_TCP_PORT;
var link = "mongodb://"+ip+":"+port+"/bookAPI";

var db = mongoose.connect(link);

var Book = require("./models/bookModel");

var app = express();

var port = process.env.PORT || 8080;

var bookRouter = express.Router();


bookRouter.route('/books')
    .get( function( req, res ){
        var query = {};
        if( req.query.genre ){
            query.genre = req.query.genre;
        }

        Book.find( query, function( err, books){
            if( err )
                res.status(500).send( err );
            else
                res.json( books );
        });

    });

bookRouter.route("/books/:bookId")
    .get( function( req, res ){
        res.json(req.params.bookId);
            Book.findById( req.params.bookId, function( err, books){
                if( err )
                    res.status(500).send( err );
                else
                    res.json(book);
            });
        });


app.use('/api', bookRouter );

app.get('/', function( req, res){
    res.send("welcome to my API!");
});

app.listen( port, function(){
    console.log( 'Running on PORT: ', + port );
});