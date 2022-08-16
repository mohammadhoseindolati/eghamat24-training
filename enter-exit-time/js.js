const add_button_element = document.querySelector(".add-btn")
const input_time_element = document.querySelector(".input-time")
const output_time_element = document.querySelector(".output-time")
const td_element = document.querySelector(".data-box tr td")
const tr_element = document.querySelector(".data-box tr")
const tbody_element = document.querySelector(".data-box table tbody")


let in_times = [] , out_times = [] , sub_dates = []


if (localStorage.getItem("in-times") !== null){
    in_times = in_times.concat(JSON.parse(localStorage.getItem("in-times")))
}
if (localStorage.getItem("out-times") !== null ){
   out_times =  out_times.concat(JSON.parse(localStorage.getItem("out-times")))
}
if (localStorage.getItem("sub-dates") !== null ){
   sub_dates = sub_dates.concat(JSON.parse(localStorage.getItem("sub-dates")))
}

prepareLocalStorage()

add_button_element.addEventListener('click' , storeOnLocalStorage)

function storeOnLocalStorage () {
    let  post_intime_value , post_outtime_value
    let d = new Date()
    let year = d.getFullYear() , month = d.getMonth() , day = d.getDay() , hours = d.getHours() , minutes = d.getMinutes() , seconds = d.getSeconds()
    let sub_date = year + '/' + month + '/' + day + ' ' + hours + ':' + minutes + ':' + seconds ;

    post_intime_value = input_time_element.value ? input_time_element.value : ""
    post_outtime_value = output_time_element.value ? output_time_element.value : ""
    
    for(let i = 0 ; i<=1000 ; i++){
        in_times.unshift(post_intime_value)
        out_times.unshift(post_outtime_value)
        sub_dates.unshift(sub_date)
    }

        let in_text = ""
        in_times.forEach(function (item, index) {
                in_text += `
                    <tr>
                    <td>${item}</td>
                    <td>${out_times[index]}</td>
                    <td>${sub_dates[index]}</td>
                    </tr>
                    `
        })

        tbody_element.innerHTML = in_text
        input_time_element.value = ''
        output_time_element.value = ''


    localStorage.setItem("in-times" , JSON.stringify(in_times))
    localStorage.setItem("out-times" , JSON.stringify(out_times))
    localStorage.setItem("sub-dates" , JSON.stringify(sub_dates))
}

function prepareLocalStorage() {
    let in_text = ""
    in_times.forEach(function (item, index) {
        in_text += `
        <tr>
        <td>${item}</td>
        <td>${out_times[index]}</td>
        <td>${sub_dates[index]}</td>
        </tr>
        `
    })
    tbody_element.innerHTML = in_text
    input_time_element.value = ''
    output_time_element.value = ''

    localStorage.setItem("in-times" , JSON.stringify(in_times))
    localStorage.setItem("out-times" , JSON.stringify(out_times))
    localStorage.setItem("sub-dates" , JSON.stringify(sub_dates))
}

