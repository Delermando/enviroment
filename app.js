var express = require('express')
    mongoose = require("mongoose")
    bodyParser = require("body-parser");

var ip = process.env.MONGO_PORT_27017_TCP_ADDR;
var port = process.env.MONGO_PORT_27017_TCP_PORT;
var link = "mongodb://"+ip+":"+port+"/bookAPI";
var db = mongoose.connect(link);
var Book = require("./models/bookModel");
var app = express();
var port = process.env.PORT || 8080;
var bookRouter = express.Router();


app.use( bodyParser.urlencoded( { extended: true } ) );
app.use( bodyParser.json() );

bookRouter.route( '/books' )
    .post( function( req, res ){
        var book = new Book( req.body );

        book.save();
        res.status( 201).send(book);
    })
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
            Book.findById( req.params.bookId, function( err, book){
                if( err )
                    res.status(500).send( err );
                else
                    res.json( book );
            });
        });


app.use('/api', bookRouter );

app.get('/', function( req, res){
    res.send("welcome to my API!");
});

app.listen( port, function(){
    console.log( 'Running on PORT: ', + port );
});