import faker from 'faker'
faker.locale = "ru";

import MockAdapter from 'axios-mock-adapter'

const mock = new MockAdapter(axios);

function makeFakeUser() {
    let firstName = faker.name.firstName();
    let lastName = faker.name.lastName();
    let middleName = faker.random.arrayElement(faker.definitions.name.male_middle_name);
    let account = faker.helpers.replaceSymbols("???#####").toLowerCase();
    return {
        'account': account,
        'name': `${lastName} ${firstName} ${middleName}`,
        'displayName': `${lastName} ${firstName} ${middleName}`,
        'firstName': firstName,
        'lastName': lastName,
        'middleName': middleName,
        'title': faker.name.title(),
        'mail': `${account}@arsenal.plm`,
        'externalMail': faker.internet.email(),
        'localPhone': faker.helpers.replaceSymbolWithNumber('##-##'),
        'cityPhone': faker.helpers.replaceSymbolWithNumber('292-##-##'),
        'mobilePhone': faker.helpers.replaceSymbolWithNumber('+7 (###) ###-####'),
        'department': "147 Отдел информационных технологий",
        'office': "Здание 87, 1 этаж, 14 комната",
        'enabled': true
    }
}

function makeFakeUsers($quantity) {
    const users = [];
    for (let i = 0; i < $quantity; i++) {
        users.push(makeFakeUser())
    }
    return users;
}


mock.onGet('/api/users').reply(200, {
    data: makeFakeUsers(1000)
});
mock.onGet(/\/api\/users\/search\?q=.+/i).reply(200, {
   data: makeFakeUsers(10)
});
mock.onAny().passThrough();



