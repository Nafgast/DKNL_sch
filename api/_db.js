const { MongoClient } = require('mongodb');

const uri = process.env.MONGODB_URI || 'mongodb+srv://Vercel-Admin-DKNL_schDB:Nly6YzK4PLcHfcZv@dknl-schdb.wu7ewyj.mongodb.net/?retryWrites=true&w=majority';

let clientPromise;
if (!global._mongoClientPromise) {
  const client = new MongoClient(uri, { useNewUrlParser: true, useUnifiedTopology: true });
  global._mongoClientPromise = client.connect();
}

async function getDb(dbName = 'nafgast') {
  const client = await global._mongoClientPromise;
  return client.db(dbName);
}

module.exports = { getDb };
