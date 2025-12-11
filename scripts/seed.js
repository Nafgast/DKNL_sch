require('dotenv').config();
const { MongoClient } = require('mongodb');
const uri = process.env.MONGODB_URI;
if (!uri) { console.error('MONGODB_URI is not set'); process.exit(1); }

(async () => {
  const client = new MongoClient(uri);
  try {
    await client.connect();
    const db = client.db('nafgast');
    await db.collection('admins').insertOne({ username: 'admin', password: 'yourpassword', name: 'Admin Name', createdAt: new Date() });
    await db.collection('students').insertOne({ username: 's123', password: 'pass', name: 'Student Name', class: 'JSS3', createdAt: new Date() });
    await db.collection('results').insertOne({ examNumber: 'EX123456', year: '2025', grades: { Math: 'A1', English: 'B2' } });
    console.log('Seed data inserted.');
  } catch (err) { console.error(err); }
  finally { await client.close(); }
})();
