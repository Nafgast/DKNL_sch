const { getDb } = require('./_db');
module.exports = async (req, res) => {
  const db = await getDb();
  const products = await db.collection('products').find({}).toArray();
  res.json({ products });
};
