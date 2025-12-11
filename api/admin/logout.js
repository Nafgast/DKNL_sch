const { getDb } = require('../_db');
module.exports = async (req, res) => {
  if (req.method !== 'POST') return res.status(405).json({ error: 'Method not allowed' });
  const { token } = req.body || {};
  if (!token) return res.status(400).json({ error: 'Missing token' });
  const db = await getDb();
  await db.collection('sessions').deleteOne({ token });
  res.json({ ok: true });
};
