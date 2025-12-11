const { getDb } = require('../_db');
const crypto = require('crypto');

module.exports = async (req, res) => {
  if (req.method !== 'POST') return res.status(405).json({ error: 'Method not allowed' });
  const { username, password } = req.body || {};
  if (!username || !password) return res.status(400).json({ error: 'Missing credentials' });
  const db = await getDb();
  const admin = await db.collection('admins').findOne({ username });
  if (!admin || admin.password !== password) return res.status(401).json({ error: 'Invalid credentials' });
  const token = crypto.randomBytes(32).toString('hex');
  await db.collection('sessions').insertOne({ token, userId: admin._id, role: 'admin', createdAt: new Date() });
  res.json({ token, user: { username: admin.username, name: admin.name } });
};
