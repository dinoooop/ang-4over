app.constant("appConfig", {
    url: "http://localhost/localdev",
});
app.constant("appData", {
    api4over: 'https://api.4over.com',
    coating: [
        {key: 'PCMATT', value: 'PC Matte'},
        {key: 'EDPCMATT', value: 'MATT/DULL FINISH'},
        {key: 'EDPCUV', value: 'UV COATING'},
        {key: 'EDPCUVFR', value: 'Gloss UV Front'},
    ],
    size: [
        {key: 'PCMATT', value: ['4.5X12']},
        {key: 'EDPCMATT', value: ['4.5X12', '6X12', '6.5X9', '6.5X12', '8X6.5', '8.5X7']},
        {key: 'EDPCUV', value: ['4.5X12', '6X12', '6.5X9', '6.5X12', '8X6.5', '8.5X7']},
        {key: 'EDPCUVFR', value: ['4.5X12', '6X12', '6.5X9', '6.5X12', '8X6.5', '8.5X7']},
    ],
    stock: [
        {key: '16PT', value: '16PT C2S'},
    ],
    products: [
        {key: '1b93dbb0-5f2d-48ba-9c2d-4cb7b60f6313', value: '16PT-PCMATT-4.5X12'},
        {key: '9083fd98-32ea-4573-b295-d35be924fdab', value: '16PT-EDPCMATT-6X12'}, // size 
        {key: '068a46d4-2644-4486-8c82-a70c80f28de9', value: '16PT-EDPCMATT-6.5X9'},
        {key: 'ab7aaa0b-97db-4e0d-9ad9-9e7322d15bbd', value: '16PT-EDPCMATT-6.5X12'},
        {key: '0d2f34e2-947b-42e1-92e7-d2b9bd0eaead', value: '16PT-EDPCMATT-8X6.5'},
        {key: 'df8463c6-a7da-415f-b186-edc6c33d3539', value: '16PT-EDPCMATT-8.5X7'},
        {key: '616a921a-6edf-4190-8fe7-6a905a74b589', value: '16PT-EDPCUV-4.5X12'},
        {key: '5abb8dd5-3a3b-4032-9d26-7ba87d1dcb6b', value: '16PT-EDPCUV-6X12'},
        {key: '061bd4ad-7d7f-4b8a-a937-bfff5ba568b2', value: '16PT-EDPCUV-6.5X9'},
        {key: 'c541607d-5c24-4c54-b298-8f5bbe4d0243', value: '16PT-EDPCUV-6.5X12'},
        {key: 'da6c843e-2621-4a3e-ac3c-218d3b62aec6', value: '16PT-EDPCUV-8X6.5'},
        {key: '2d96b99f-57ec-4e0f-9adb-184870382710', value: '16PT-EDPCUV-8.5X7'},
        {key: 'd8cc7003-3389-47b1-bfbb-1980119a2a03', value: '16PT-EDPCUVFR-4.5X12'},
        {key: 'ce39e585-a381-4e3b-8627-55bc8eef35ab', value: '16PT-EDPCUVFR-6X12'},
        {key: '617f8609-9bfe-4384-8c4a-54590582719a', value: '16PT-EDPCUVFR-6.5X9'},
        {key: '8c3c0cc7-568e-4eeb-ad84-e76906f49681', value: '16PT-EDPCUVFR-6.5X12'},
        {key: 'fe7babe9-a799-468c-8346-21b2a51aceaa', value: '16PT-EDPCUVFR-8X6.5'},
        {key: '8c4d8667-5884-4788-8a77-b053005bb1fb', value: '16PT-EDPCUVFR-8.5X7'},
    ],
    color: [
        {key: '13abbda7-1d64-4f25-8bb2-c179b224825d', value: '4/4'}
    ],
    runsize: [
        {key: '8a3a0fd1-38ae-49a0-8736-3fedadc3dc93', value: '100'},
        {key: '6237a36b-b046-4ef6-8fed-6cb9c22a5ece', value: '250'},
        {key: 'f593fda3-2d5c-4b9e-9c2c-6197b899ae74', value: '500'},
        {key: '52e3d710-0e8f-4d4d-8560-7d4d8655be69', value: '1000'},
        {key: '02d8d163-ee8f-41cc-acce-9863ad0deb38', value: '2500'},
        {key: 'e824bf9f-d22d-4070-926d-42c6dd5ef515', value: '5000'},
        {key: '64880f6e-cc7a-4974-838c-92be09e9eb52', value: '7500'},
        {key: '4c29185a-ec98-4488-8729-c2ae0e5f5fe1', value: '10000'},
        {key: '8055b2b4-3fe2-4c57-beaf-a64ec10aed49', value: '15000'},
        {key: '889aa9a1-d0cc-4fb2-869c-73e1fe60855b', value: '20000'},
        {key: 'b7d68b88-db18-469d-97df-9c11d710ed32', value: '25000'},
    ],
});