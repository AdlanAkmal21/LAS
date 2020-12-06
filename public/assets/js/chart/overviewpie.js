// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Nunito"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

// Pie Chart of Gender Percentage
var ctx1 = document.getElementById("genderchart");
var male_count = jsbinder.male_count;
var female_count = jsbinder.female_count;
var gender_total = male_count + female_count;
var male_percentage = Math.round((male_count / gender_total) * 100);
var female_percentage = Math.round((female_count / gender_total) * 100);

var genderchart = new Chart(ctx1, {
    type: "doughnut",
    data: {
        labels: ["Male", "Female"],
        datasets: [
            {
                data: [male_percentage, female_percentage],
                backgroundColor: ["#536DFE", "#F06292"],
                hoverBackgroundColor: ["#304FFE", "#E91E63"],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            },
        ],
    },
    options: {
        title: {
            display: true,
            text: 'Employee Gender (%)',
            fontSize: 18,
            padding: 16,
        },
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: true,
            position: 'bottom',
            labels: {
                padding: 25,
                usePointStyle: true
            }
        },
        cutoutPercentage: 50,
        animation: {
            onComplete: function () {
                if (gender_total === 0) {
                    document.getElementById('genderchartnone').style.display = 'block';
                    document.getElementById('genderchart').style.display = 'none';
                }
            }
          }
    },
});

// Pie Chart of Applications Status Percentage
var ctx2 = document.getElementById("applicationstatuschart");
var pending_count = jsbinder.pending_count;
var approve_count = jsbinder.approve_count;
var reject_count = jsbinder.reject_count;
var application_total = pending_count + approve_count + reject_count;
var pending_percentage = Math.round((pending_count / application_total) * 100);
var approve_percentage = Math.round((approve_count / application_total) * 100);
var reject_percentage = Math.round((reject_count / application_total) * 100);

var applicationstatuschart = new Chart(ctx2, {
    type: "doughnut",
    data: {
        labels: ["Pending", "Approve", "Rejected"],
        datasets: 
        [
            {
                data: [
                    pending_percentage,
                    approve_percentage,
                    reject_percentage,
                ],
                backgroundColor: ["#FFEE58", "#9CCC65", "#E53935"],
                hoverBackgroundColor: ["#FDD835", "#8BC34A", "#B71C1C"],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            },
        ],
    },
    options: {
        title: {
            display: true,
            text: 'Application Overall Status (%)',
            fontSize: 18,
            padding: 16,
        },
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: true,
            position: 'bottom',
            labels: {
                padding: 22,
                usePointStyle: true
            }
        },
        cutoutPercentage: 50,
        animation: {
            onComplete: function () {
                if (application_total === 0) {
                    document.getElementById('applicationstatuschartnone').style.display = 'block';
                    document.getElementById('applicationstatuschart').style.display = 'none';
                }
            }
          }
        
    },

});


// Pie Chart of Roles Percentage
var ctx3 = document.getElementById("roleschart");
var admin_count = jsbinder.admin_count;
var employee_count = jsbinder.employee_count;
var approver_count = jsbinder.approver_count;
var roles_total  = admin_count + employee_count + approver_count;
var admin_percentage = Math.round((admin_count / roles_total) * 100);
var employee_percentage = Math.round((employee_count / roles_total) * 100);
var approver_percentage = Math.round((approver_count / roles_total) * 100);

var roleschart = new Chart(ctx3, {
    type: "doughnut",
    data: {
        labels: ["Admin", "Employee", "Approver"],
        datasets: 
        [
            {
                data: [
                    admin_percentage,
                    employee_percentage,
                    approver_percentage,
                ],
                backgroundColor: ["#FFEE58", "#9CCC65", "#E53935"],
                hoverBackgroundColor: ["#FDD835", "#8BC34A", "#B71C1C"],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            },
        ],
    },
    options: {
        title: {
            display: true,
            text: 'Roles (%)',
            fontSize: 18,
            padding: 16,
        },
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: true,
            position: 'bottom',
            labels: {
                padding: 25,
                usePointStyle: true
            }
        },
        cutoutPercentage: 50,
        animation: {
            onComplete: function () {
                if (roles_total === 0) {
                    document.getElementById('roleschartnone').style.display = 'block';
                    document.getElementById('roleschart').style.display = 'none';
                }
            }
          }
        
    },

});


// Pie Chart of Employee Status Percentage
var ctx4 = document.getElementById("empstatuschart");
var working_count = jsbinder.working_count;
var resigned_count = jsbinder.resigned_count;
var emp_status_total  = working_count + resigned_count;
var working_percentage = Math.round((working_count / emp_status_total) * 100);
var resign_percentage = Math.round((resigned_count / emp_status_total) * 100);

var empstatuschart = new Chart(ctx4, {
    type: "doughnut",
    data: {
        labels: ["Working", "Resigned"],
        datasets: 
        [
            {
                data: [
                    working_percentage,
                    resign_percentage,
                ],
                backgroundColor: ["#FFEE58", "#9CCC65", "#E53935"],
                hoverBackgroundColor: ["#FDD835", "#8BC34A", "#B71C1C"],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            },
        ],
    },
    options: {
        title: {
            display: true,
            text: 'Employee Working Status (%)',
            fontSize: 18,
            padding: 16,
        },
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: true,
            position: 'bottom',
            labels: {
                padding: 25,
                usePointStyle: true
            }
        },
        cutoutPercentage: 50,
        animation: {
            onComplete: function () {
                if (roles_total === 0) {
                    document.getElementById('empstatuschartnone').style.display = 'block';
                    document.getElementById('empstatuschart').style.display = 'none';
                }
            }
          }
        
    },

});

// Pie Chart of Individual Applications Status Percentage
var ctx5 = document.getElementById("thisyearapplicationchart");
var applications_count = jsbinder.applications_count;
var applications_this_year_count = jsbinder.applications_this_year_count;

var this_year  = Math.round((applications_this_year_count / applications_count) * 100);
var other_year = 100-this_year;
var thisyearapplicationchart = new Chart(ctx5, {
    type: "doughnut",
    data: {
        labels: ["Other Year", "This Year"],
        datasets: 
        [
            {
                data: [
                    other_year,
                    this_year,
                ],
                backgroundColor: ["#FFEE58", "#9CCC65", "#E53935"],
                hoverBackgroundColor: ["#FDD835", "#8BC34A", "#B71C1C"],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            },
        ],
    },
    options: {
        title: {
            display: true,
            text: 'Total Applications (%)',
            fontSize: 18,
            padding: 16,
        },
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: true,
            position: 'bottom',
            labels: {
                padding: 25,
                usePointStyle: true
            }
        },
        cutoutPercentage: 50,
        animation: {
            onComplete: function () {
                if (applications_count === 0) {
                    document.getElementById('thisyearapplicationchartnone').style.display = 'block';
                    document.getElementById('thisyearapplicationchart').style.display = 'none';
                }
            }
          }
        
    },

});
