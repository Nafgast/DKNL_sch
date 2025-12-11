const { getDb } = require('../_db');
const { ObjectId } = require('mongodb');
module.exports = async (req, res) => {
  const token = req.query.token || (req.body && req.body.token);
  if (!token) return res.status(401).json({ error: 'Missing token' });
  const db = await getDb();
  const session = await db.collection('sessions').findOne({ token });
  if (!session) return res.status(401).json({ error: 'Invalid token' });
  const admin = await db.collection('admins').findOne({ _id: ObjectId(session.userId) });
  res.json({ admin: { username: admin.username, name: admin.name } });
};
