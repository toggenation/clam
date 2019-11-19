import utils from '../../Utility/utilities';
export const updateObject = ( oldObject, newValues ) => ({
        ...oldObject,
        ...newValues
    })

export const calcPartStartTime = (meetings, meetingId, partIds, partEntities, partId) => {

    let totalMinutes = 0
    let startTime = ''
    let partStartTime = ''
    let newPartStartTime = ''

    startTime = meetings[meetingId].startTime

    let haveSeen = false

    partIds.forEach((partIdMap, index) => {

        haveSeen = haveSeen ? true : false;

        if (index === 0) {
            totalMinutes = 0 // start from 0
        }

        let partMinutes = parseInt(partEntities[partIdMap].minutes)
        let counselMinutes = parseInt(partEntities[partIdMap].counsel_mins)

        if (partIdMap === partId) {
            haveSeen = true
            partStartTime = utils.formatDate(startTime, 'h:mmA')
            newPartStartTime = partStartTime.add(totalMinutes, 'm')
        }

        if (!haveSeen) {
            totalMinutes += partMinutes + counselMinutes
        }

    })

    return newPartStartTime.format()

}
