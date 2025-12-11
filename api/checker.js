import { getDb } from './_db';

export default async function handler(req, res) {
  if (req.method !== 'POST') {
    return res.status(405).json({ error: 'Method not allowed' });
  }

  const { examNumber, year } = req.body || {};

  if (!examNumber) {
    return res.status(400).json({ error: 'Missing examNumber' });
  }

  try {
    const db = await getDb();
    const result = await db.collection('results').findOne({ examNumber, year });

    if (!result) {
      return res.status(404).json({ found: false });
    }

    res.json({ found: true, result });
  } catch (error) {
    res.status(500).json({ error: 'Internal server error' });
  }
}
