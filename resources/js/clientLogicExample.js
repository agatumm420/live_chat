import Echo from 'laravel-echo';
import Pusher from 'pusher-js';


window.Pusher = Pusher;

// window.Pusher.connection.bind('ping', ()=>{ //ping czy pong

// });
function postData(url ,e) {
    return new Promise((resolve, reject) =>{
        let data= e.hasOwnProperty('data')?{
            'data':{
                'name':e.data.name,
                'user_id':e.data.user_id,
                'members':e.data.members,

            }
          }:{
            'data':{
                'channel':process.env.MIX_CHANNEL, //correct it!
                'socketId':e
            }
          };
      console.log(data);
      // Default options are marked with *
      fetch(url, {
        method: 'POST', // *GET, POST, PUT, DELETE, etc.

        headers: {
          'Content-Type': 'application/json'
          // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        // body:data,
        body: JSON.stringify(data),
      // body data type must match "Content-Type" header
      });
    }).then((response) => response.json()
    .then((res) => {
    resolve(res);
    }))
    .catch((error) => {
    console.log(error)
    });

       // parses JSON response into native JavaScript objects
    };
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        // wsHost: process.env.APP_WEBSOCKET_SERVER,
        wsHost: '127.0.0.1',
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        wsPort: 6001,
        forceTLS:false,
        disableStats: true,
        enabledTransports: ['ws', 'wss']

    });

const CreateRoom=()=>{ //use when someone clicks to create room
    postData('http://127.0.0.1:8000/create_room',{
        'data':{
            'name':'test_room',
            'user_id':1,
            'members':[{
                'login':'buniaxdd'
            },
            {
                'login':'bartekz'
            },
            {
                'login':'GodOfHellFire'
            }
        ]
        }
    }).then((result) => {
            let parsed=JSON.parse(result);
            let data= parsed['data'];
            window.Echo.join(data['room_id'])
            .listen('message.send',  (e)=>{
                //###   do something with the message for exmaple respond

                postData(`http://127.0.0.1:8000/api/send/${data['room_id']}`, e).then((result) => {

                    console.log(result);});

            })
            .here(()=>{
                 // for example send automatic stuff for example greeting
            })
            .joining(()=>{
                //when new user joins
            })
            ;
        console.log(result);});
}

