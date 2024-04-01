// courses.js
const aCourse = {
    code: "CSE121b",
    name: "Javascript Language",
   
    sections: [
        {
            sectionNum: 1,
            roomNum: 'STC353',
            enrolled: 26,
            days: 'TTh',
            instructor: 'Bro T',
        },
        {
            sectionNum: 2,
            roomNum: 'STC 347',
            enrolled: 28,
            days: 'TTh',
            instructor: 'Sis A',
        }
    ],
   
    manageStudent: function(sectionNum, action) {
      const sectionExists = (section) => section.sectionNum == sectionNum;
      let sectionIndex = this.sections.findIndex (sectionExists);
      if (sectionIndex != -1){
        if (action == "add") {
          this.sections[sectionIndex].enrolled++;
        }
        else {
          this.sections[sectionIndex].enrolled--;
        }
        renderSections(this.sections);
      }
    }

    /*
    enrollStudent: function(sectionNum) {
      const sectionExists = (section) => section.sectionNum == sectionNum;
      let sectionIndex = this.sections.findIndex(sectionExists);
      if (sectionIndex >= 0)
      {
        this.sections[sectionIndex].enrolled++;
        renderSections(this.sections);
      }
   },

   dropStudent: function(sectionNum) {
    const sectionExists = (section) => section.sectionNum == sectionNum;
    let sectionIndex = this.sections.findIndex(sectionExists);
    if (sectionIndex != -1)
    {
      this.sections[sectionIndex].enrolled--;
      renderSections(this.sections);
    }
 } */

  };

  function setCourseInfo(course) {
    document.querySelector('#courseName').textContent = course.name;
    document.querySelector('#courseCode').textContent = course.code;
  }

  function renderSections(sections) {
    const htmlText = sections.map((section) => `<tr>
        <td>${section.sectionNum}</td>
        <td>${section.roomNum}</td>
        <td>${section.enrolled}</td>
        <td>${section.days}</td>
        <td>${section.instructor}</td>`
    );
    document.querySelector('#sections').innerHTML = htmlText.join("");
  }

   document.querySelector('#enrollStudent').addEventListener("click", function () {
    const mySection = document.querySelector("#sectionNumber").value;
    aCourse.manageStudent(mySection, "add");
  } );
  document.querySelector('#dropStudent').addEventListener("click", function () {
    const mySection = document.querySelector("#sectionNumber").value;
    aCourse.manageStudent(mySection, "drop");
  });

  setCourseInfo(aCourse);
  renderSections(aCourse.sections);