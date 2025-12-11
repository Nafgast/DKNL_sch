const { getDb } = require('./_db');

module.exports = async (req, res) => {
  if (req.method !== 'POST') return res.status(405).json({ error: 'Method not allowed' });
  const data = req.body;
  if (!data) return res.status(400).json({ error: 'Missing form data' });
  const db = await getDb();
  await db.collection('admissions').insertOne({ ...data, createdAt: new Date() });
  res.json({ success: true });
};
