db = db.getSiblingDB('newdb')

db.createUser({
  user: 'test',
  pwd: 'test',
  roles: [
    {
      role: 'readWrite',
      db: 'newdb',
    },
  ],
})
