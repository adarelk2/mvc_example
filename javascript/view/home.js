import {get} from "../helpers/ajax.js";
import {API_LINK} from "../Const/api.js"
window.onload = ()=>
{
    init();
    declareViewEvent();
}
let table = null;
let Rows = [];

const init = async()=>
{
    const params = filters();///for the future - if want to filter rows by server side
    Rows = await getUsers(params)
    const tbody = 
    [
        {
            key:"name",
            title:"Name",
            method:"text"
        },
        {
            key:"email",
            title:"Email",
            method:"text"
        },
        {
            key:"country",
            title:"Country",
            method:"text"
        },
        {
            key:"age",
            title:"Age",
            method:"text"
        },
        {
            title:"Picture",
            method:"function",
            callback:createPicture
        },
        {
            title:"Flag",
            method:"function",
            callback:createFlag
        }
    ]

    const config = 
    {
        classTable:"table mx-auto mt-3 text-center",
        rows:Rows,
        styleTable:"width:80%;",
        tbody:tbody
    }

    table = new Vertical_Table(".show_list",config);
    table.render();
}

const getUsers = (_filters)=>
{
    return get(API_LINK.home,{method:"getUsers",params:_filters}).then(res=>{
        return res.msg;
    }).catch(err=>{
        console.log(err);
        return [];
    })
}

const filters = ()=>
{
    const params = 
    {
        name:$("#name").val()
    }

    return params;
}

const createPicture  = (_row)=>
{
    return `<img src='${_row.profile_pic}' class='w-25'>`;
}

const createFlag  = (_row)=>
{
    return `<img src='https://countryflagsapi.com/png/${_row.country}' style='width:50px;height:50px;'>`;
}

const declareViewEvent = ()=>
{
    $("#name,#age").keyup(function(){
        const params = filters();
        let ar = Rows.filter(row=>{
            let flag = false;
            if(row.name.toUpperCase().indexOf(params.name.toUpperCase()) >= 0)
            {
               flag = true; 
            }

            return flag;
        }) 
        table.setRows(ar);
        table.render();
    })

    $(".getNewUsers").on("click",function(){
        loadNewUsers(5);
    })
}

const loadNewUsers = (_count=0)=>
{
    get(API_LINK.home, {method:"saveUsers", params:{count:_count}}).then(res=>{
        if(res.state)
        {
            init();
        }
        else
        {
            Swal.fire("הפעולה נכשלה", res.msg, 'error')
        }
    })
}