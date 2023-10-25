[
    {
        name : "Hotel de ville",
        description : "L'hôtel de ville est le bâtiment central autour duquel le village du joueur est construit.",
        states : [
            {
                buildingLevel: 0,
                image : "image0",
                upgardeCost : 100,
                upgardeReward : 20,
            },
        ],
    },
    {
        name : "Caserne",
        description : "La caserne est un bâtiment militaire qui permet aux joueurs de former et de mettre à niveau leurs troupes.",
        hdvRequired : 1,
        states : [
            {
                buildingLevel: 0,
                image : "image0",
                upgardeCost : 100,
                upgardeReward : 20,
            },
            {
                buildingLevel: 1,
                image : "image1",
                upgardeCost : 130,
                upgardeReward : 30,
            },
            {
                buildingLevel: 2,
                upgardeCost : 130,
                upgardeReward : 30,
            },
            {
                buildingLevel: 3,
                upgardeCost : 130,
                image : "image3",
                upgardeReward : 30,
            }
        ],
    },
]

// {
//     name : "Caserne",
//     description : "La caserne est un bâtiment militaire qui permet aux joueurs de former et de mettre à niveau leurs troupes",
//     images : [
//         {
//             buildinglevel : 0,
//             src : "...."            
//         },
//         {
//             buildinglevel : 1,
//             src : "...."            
//         },
//         {
//             buildinglevel : 2,
//             src : "...."            
//         },
//     ],
//     maxLevel : 5,
//     upgardeParams : [
//         {
//             buildingLevel: 0,
//             upgardeCost : 100,
//             upgardeReward : 20,
//         },
//         {
//             buildingLevel: 1,
//             upgardeCost : 130,
//             upgardeReward : 30,
//         }
//     ],
// },