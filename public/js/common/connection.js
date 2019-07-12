/**
 * Common connection class
 */
 var mysql = require('mysql');
 var config = require('../../assets/json/config');
 var connection = mysql.createConnection({ 
		     host : config.host,
		     user : config.user,
		     password : config.password,
		     database : config.database,
		 });
 module.exports = connection;