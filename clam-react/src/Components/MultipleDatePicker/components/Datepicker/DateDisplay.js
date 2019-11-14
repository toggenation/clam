import React, { Component } from 'react';
import styled from 'styled-components';
import { dateTimeFormat } from './dateUtils';
// background-color: rgb(0, 188, 212);
const Root = styled.div`
  width: 165px;
  height: 280px;
  float: left;
  font-weight: 700;
  background-color: rgb(240, 240, 240);
  display: inline-block;
  border-top-left-radius: .25rem;
  border-top-right-radius: 0px;
  border-bottom-left-radius: .25rem;
  color: rgb(0, 0, 0);
  padding: 20px;
  box-sizing: border-box;
  overflow-y: auto;
`;

const DateTime = styled.div`
  position: relative;
  overflow: hidden;
  height: 16px;
  margin: 0px 0px 10px;
  font-size: 16px;
  font-weight: 500;
  line-height: 16px;
  transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;
`;

class DateDisplay extends Component {
  state = {
    selectedYear: false,
  };

  componentWillMount() {
    if (!this.props.monthDaySelected) {
      this.setState({ selectedYear: true });
    }
  }

  getFormatedDate = date => {
    const dateTime = new dateTimeFormat('en-US', {
      year: 'numeric',
      month: 'short',
      day: '2-digit',
    }).format(date);

    return `${dateTime}`;
  };

  render() {
    const { selectedDates } = this.props;

    return (
      <Root>
        {selectedDates.map(date => <DateTime key={`${date.toString()}`}>{this.getFormatedDate(date)}</DateTime>)}
      </Root>
    );
  }
}

export default DateDisplay;
