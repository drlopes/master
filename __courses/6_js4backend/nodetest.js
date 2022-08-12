const client = {
  name: 'Jane Doe',
  age: 25,
  id: 123456,
  pocketMoney: 50,
  contact: {
    knownEmails: [
      'email@domain.com',
      'anotheremail@anotherdomain.com'
    ],
    knownPhoneNumbers: [
      '01555444',
      '551234567'
    ],
  },
  presentation: function () {
    console.log(`I'm ${this.name} and my email address is ${this.contact.knownEmails[0]}`);
  }
}

const generateRel = (object) => {
  let rel = '';
  for (let key in object) {
    if (typeof object[key] === 'object' || typeof object[key] === 'function') {
      continue
    } else { rel += `${key}: ${object[key]}\n`; }
  }
  console.log(rel);
}

//generateRel(client);
console.table(client.contact.knownEmails);
