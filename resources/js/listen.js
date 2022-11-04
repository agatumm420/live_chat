import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

console.log('Im at the start')
window.Pusher = Pusher;
console.log('Im at the start')
// window.Pusher.connection.bind('ping', ()=>{ //ping czy pong

// });
function sendMessage(url ,e) {
    return new Promise((resolve, reject) =>{
        let data= e.hasOwnProperty('data')?{
            'data':{
                'display_id':e.data.display_id,
                'file_name':e.data.file_name,
                'file_id':e.data.file_id,
                'html':e.data.html
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
// window.Echo.connector.pusher.connection.bind("connected", function(){
//     let socketId=window.Echo.socketId()
//     ; //wpisz do pliku
//     console.log('connected' );
//     postData('http://127.0.0.1:8000/api/set_socketId', socketId
//     ).then((result)=>console.log(result))
//      console.log('connected' );
//   });
// ConnectToWebsocket();


console.log('I m close');
// window.Pusher.connection.bind('pusher:connection_established', ()=>{ //ping czy pong
//     console.log('connected' );
// });

window.Echo.connector.pusher.connection.bind('disconnected', function(){
    console.log("i'm disconection");
} );
window.Echo.join(process.env.MIX_CHANNEL).listen('.print.send',  (e)=>{
    //window.Echo.channels[process.env.CHANNEL].subscription.bind('pusher:subscription_succeeded', function(){
    //     let socketId=window.Echo.socketId(); //wpisz do pliku
    //     postData('http://127.0.0.1:8000/api/set_socketId', {
    //         'data':{
    //             'socketId':socketId,
    //         }
    // }).then((result)=>console.log(result))
    //      console.log('connected', )
    //   });
    console.log("i m here");

      //Livewire.emit()
    postData('http://127.0.0.1:8000/api/print', e).then((result) => {console.log(result);});

});
// function ConnectToWebsocket(){
//     const socket=new WebSocket(`ws:///127.0.0.1:6001/my-websocket/app/${process.env.MIX_PUSHER_APP_KEY}/channel/${process.env.MIX_CHANNEL}`)

//     socket.onopen=function(Event){
//         console.log('on open');
//     }
//     socket.onclose=function(Event){
//         console.log("im closed");
//     }
// }
