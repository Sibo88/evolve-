!function() {

    var today = moment();
  
    function Calendar(selector, attendanceData) {
      this.el = document.querySelector(selector);
      this.attendanceData = attendanceData;
      this.current = moment().date(1);
      this.draw();
      var current = document.querySelector('.today');
      if(current) {
        var self = this;
        window.setTimeout(function() {
          self.openDay(current);
        }, 500);
      }
    }
  
    Calendar.prototype.draw = function() {
      this.drawHeader();
      this.drawMonth();
      this.drawLegend();
    }
  
    Calendar.prototype.drawHeader = function() {
      var self = this;
      if(!this.header) {
        this.header = createElement('div', 'header');
        this.header.className = 'header';
  
        this.title = createElement('h1');
  
        var right = createElement('div', 'right');
        right.addEventListener('click', function() { self.nextMonth(); });
  
        var left = createElement('div', 'left');
        left.addEventListener('click', function() { self.prevMonth(); });
  
        this.header.appendChild(this.title); 
        this.header.appendChild(right);
        this.header.appendChild(left);
        this.el.appendChild(this.header);
      }
  
      this.title.innerHTML = this.current.format('MMMM YYYY');
    }
  
    Calendar.prototype.drawMonth = function() {
      var self = this;
      
      if(this.month) {
        this.oldMonth = this.month;
        this.oldMonth.className = 'month out ' + (self.next ? 'next' : 'prev');
        this.oldMonth.addEventListener('webkitAnimationEnd', function() {
          self.oldMonth.parentNode.removeChild(self.oldMonth);
          self.month = createElement('div', 'month');
          self.backFill();
          self.currentMonth();
          self.fowardFill();
          self.el.appendChild(self.month);
          window.setTimeout(function() {
            self.month.className = 'month in ' + (self.next ? 'next' : 'prev');
          }, 16);
        });
      } else {
          this.month = createElement('div', 'month');
          this.el.appendChild(this.month);
          this.backFill();
          this.currentMonth();
          this.fowardFill();
          this.month.className = 'month new';
      }
    }
  
    Calendar.prototype.backFill = function() {
      var clone = this.current.clone();
      var dayOfWeek = clone.day();
  
      if(!dayOfWeek) { return; }
  
      clone.subtract('days', dayOfWeek + 1);
  
      for(var i = dayOfWeek; i > 0 ; i--) {
        this.drawDay(clone.add('days', 1));
      }
    }
  
    Calendar.prototype.fowardFill = function() {
      var clone = this.current.clone().add('months', 1).subtract('days', 1);
      var dayOfWeek = clone.day();
  
      if(dayOfWeek === 6) { return; }
  
      for(var i = dayOfWeek; i < 6 ; i++) {
        this.drawDay(clone.add('days', 1));
      }
    }
  
    Calendar.prototype.currentMonth = function() {
      var clone = this.current.clone();
  
      while(clone.month() === this.current.month()) {
        this.drawDay(clone);
        clone.add('days', 1);
      }
    }
  
    Calendar.prototype.getWeek = function(day) {
      if(!this.week || day.day() === 0) {
        this.week = createElement('div', 'week');
        this.month.appendChild(this.week);
      }
    }
  
    Calendar.prototype.drawDay = function(day) {
      var self = this;
      this.getWeek(day);
  
      var attendance = this.getAttendanceForDay(day);
  
      //Outer Day
      var outer = createElement('div', this.getDayClass(day, attendance));
      outer.addEventListener('click', function() {
        self.openDay(this);
      });
  
      //Day Name
      var name = createElement('div', 'day-name', day.format('ddd'));
  
      //Day Number
      var number = createElement('div', 'day-number', day.format('DD'));
  
      outer.appendChild(name);
      outer.appendChild(number);
      this.week.appendChild(outer);
    }
  
    Calendar.prototype.getAttendanceForDay = function(day) {
      var attendance = this.attendanceData.find(function(att) {
        return moment(att.date).isSame(day, 'day');
      });
      return attendance ? attendance.status : null;
    }
  
    Calendar.prototype.getDayClass = function(day, attendance) {
      var classes = ['day'];
      if(day.month() !== this.current.month()) {
        classes.push('other');
      } else if (today.isSame(day, 'day')) {
        classes.push('today');
      }
  
      if(attendance === 'present') {
        classes.push('green');
      } else if(attendance === 'absent') {
        classes.push('red');
      } else if(attendance === 'holiday') {
        classes.push('yellow');
      }
  
      return classes.join(' ');
    }
  
    Calendar.prototype.drawLegend = function() {
      var legend = createElement('div', 'legend');
      var entries = [
        { status: 'Present', color: 'green' },
        { status: 'Absent', color: 'red' },
        { status: 'Holiday', color: 'yellow' }
      ];
  
      entries.forEach(function(entry) {
        var item = createElement('span', 'entry ' + entry.color, entry.status);
        legend.appendChild(item);
      });
      this.el.appendChild(legend);
    }
  
    Calendar.prototype.nextMonth = function() {
      this.current.add('months', 1);
      this.next = true;
      this.draw();
    }
  
    Calendar.prototype.prevMonth = function() {
      this.current.subtract('months', 1);
      this.next = false;
      this.draw();
    }
  
    window.Calendar = Calendar;
  
    function createElement(tagName, className, innerText) {
      var ele = document.createElement(tagName);
      if(className) {
        ele.className = className;
      }
      if(innerText) {
        ele.innerText = innerText;
      }
      return ele;
    }
  }();
  
  !function() {
    var attendanceData = [
      { date: '2024-10-01', status: 'present' },
      { date: '2024-10-02', status: 'absent' },
      { date: '2024-10-03', status: 'holiday' },
      { date: '2024-10-04', status: 'present' },
      { date: '2024-10-05', status: 'absent' }
    ];
  
    var calendar = new Calendar('#calendar', attendanceData);
  
  }();
